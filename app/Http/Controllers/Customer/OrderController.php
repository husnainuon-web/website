<?php

namespace App\Http\Controllers\Customer;

use App\Services\CustomerCart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function checkout(Request $request): View|RedirectResponse
    {
        $quantities = CustomerCart::items($request);
        if (!$quantities) {
            return redirect()->route('customer.cart.index')->with('error', 'Your cart is empty.');
        }

        $products = DB::table('products')->whereIn('id', array_keys($quantities))->get()->keyBy('id');
        $cartItems = collect($quantities)->map(function (int $quantity, int|string $productId) use ($products) {
            $product = $products->get($productId);

            return $product ? (object) ['product' => $product, 'quantity' => $quantity] : null;
        })->filter()->values();
        $availabilityRequests = array_map('intval', $request->session()->get('customer_availability_requests', []));
        $cartItems->each(function ($item) use ($availabilityRequests) {
            $item->availabilityRequested = in_array((int) $item->product->id, $availabilityRequests, true);
        });
        $total = $cartItems->sum(fn ($item) => (float) $item->product->price * $item->quantity);

        return view('customer.orders.check', compact('cartItems', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:50'],
            'shipping_address' => ['required', 'string', 'max:5000'],
            'city' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $quantities = CustomerCart::items($request);
        if (!$quantities) {
            return redirect()->route('customer.cart.index')->with('error', 'Your cart is empty.');
        }

        $availabilityRequests = array_map(
            'intval',
            $request->session()->get('customer_availability_requests', [])
        );
        $orderId = DB::transaction(function () use ($quantities, $validated, $availabilityRequests) {
            $products = DB::table('products')
                ->whereIn('id', array_keys($quantities))
                ->where('status', true)
                ->get()
                ->keyBy('id');

            if ($products->count() !== count($quantities)) {
                abort(422, 'One or more products are no longer available.');
            }

            $total = 0;
            foreach ($quantities as $productId => $quantity) {
                $product = $products->get($productId);
                $availabilityRequested = in_array((int) $productId, $availabilityRequests, true);
                if ($quantity < 1 || (!$availabilityRequested && $quantity > $product->stock)) {
                    abort(422, 'One or more quantities exceed current stock.');
                }
                $total += (float) $product->price * $quantity;
            }

            $orderId = DB::table('orders')->insertGetId([
                'user_id' => Auth::id(),
                'order_number' => 'ZM-' . strtoupper(Str::random(12)),
                'total_amount' => $total,
                'status' => 'pending',
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'] ?? null,
                'shipping_address' => $validated['shipping_address'],
                'city' => $validated['city'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($quantities as $productId => $quantity) {
                $product = $products->get($productId);
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => (float) $product->price * $quantity,
                    'availability_requested' => in_array((int) $productId, $availabilityRequests, true),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return $orderId;
        });

        CustomerCart::clear($request);
        $request->session()->forget('customer_availability_requests');
        if (!Auth::check()) {
            $request->session()->put(
                'customer_order_ids',
                array_values(array_unique([...$request->session()->get('customer_order_ids', []), $orderId]))
            );
        }

        return redirect()->route('customer.orders.show', $orderId)->with('success', 'Your order has been placed.');
    }

    public function index(Request $request): View
    {
        $query = DB::table('orders')->orderByDesc('created_at');
        if (Auth::check()) {
            $query->where('user_id', Auth::id());
        } else {
            $ids = $request->session()->get('customer_order_ids', []);
            $query->whereIn('id', $ids ?: [0]);
        }

        $orders = $query->paginate(15);
        $orders->getCollection()->transform(function ($order) {
            $order->items_count = DB::table('order_items')->where('order_id', $order->id)->sum('quantity');
            $order->created_at = \Carbon\Carbon::parse($order->created_at);

            return $order;
        });

        return view('customer.orders.index', compact('orders'));
    }

    public function show(Request $request, int $order): View
    {
        $orderRow = DB::table('orders')->where('id', $order)->firstOrFail();
        $owned = Auth::check()
            ? (int) $orderRow->user_id === (int) Auth::id()
            : in_array($order, array_map('intval', $request->session()->get('customer_order_ids', [])), true);
        abort_unless($owned, 404);

        $orderRow->created_at = \Carbon\Carbon::parse($orderRow->created_at);
        $items = DB::table('order_items')->where('order_id', $order)->get();

        return view('customer.orders.show', ['order' => $orderRow, 'items' => $items]);
    }

    public function storeDirect(Request $request, int $product): RedirectResponse
    {
        $validated = $request->validate(['quantity' => ['nullable', 'integer', 'min:1']]);
        $productRow = DB::table('products')->where('id', $product)->where('status', true)->firstOrFail();
        $quantity = (int) ($validated['quantity'] ?? 1);
        $currentQuantity = CustomerCart::items($request)[$product] ?? 0;
        $availabilityRequests = array_map(
            'intval',
            $request->session()->get('customer_availability_requests', [])
        );

        if ($productRow->stock < $currentQuantity + $quantity) {
            $availabilityRequests[] = $product;
        } else {
            $availabilityRequests = array_values(array_diff($availabilityRequests, [$product]));
        }

        $request->session()->put(
            'customer_availability_requests',
            array_values(array_unique($availabilityRequests))
        );
        CustomerCart::add($request, $product, $quantity);

        return redirect()->route('customer.checkout');
    }
}
