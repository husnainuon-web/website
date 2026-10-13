<?php

namespace App\Http\Controllers\Customer;

use App\Services\CustomerCart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $quantities = CustomerCart::items($request);
        $products = $quantities
            ? DB::table('products')->whereIn('id', array_keys($quantities))->get()->keyBy('id')
            : collect();
        $cartItems = collect($quantities)->map(function (int $quantity, int|string $productId) use ($products) {
            $product = $products->get($productId);

            return $product ? (object) ['product' => $product, 'quantity' => $quantity] : null;
        })->filter()->values();
        $total = $cartItems->sum(fn ($item) => (float) $item->product->price * $item->quantity);

        return view('customer.cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request, int $product): RedirectResponse
    {
        $validated = $request->validate(['quantity' => ['nullable', 'integer', 'min:1']]);
        $productRow = DB::table('products')->where('id', $product)->where('status', true)->firstOrFail();
        $quantity = (int) ($validated['quantity'] ?? 1);
        $currentQuantity = CustomerCart::items($request)[$product] ?? 0;

        if ($productRow->stock < $currentQuantity + $quantity) {
            return back()->withErrors(['quantity' => 'The requested quantity is not available.']);
        }

        CustomerCart::add($request, $product, $quantity);

        return redirect()->route('customer.cart.index')->with('success', 'Product added to your cart.');
    }

    public function update(Request $request, int $product): RedirectResponse
    {
        $validated = $request->validate(['quantity' => ['required', 'integer', 'min:1']]);
        $productRow = DB::table('products')->where('id', $product)->where('status', true)->firstOrFail();

        if ($productRow->stock < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'The requested quantity is not available.']);
        }

        CustomerCart::setQuantity($request, $product, $validated['quantity']);

        return redirect()->route('customer.cart.index')->with('success', 'Cart updated.');
    }

    public function destroy(Request $request, int $product): RedirectResponse
    {
        CustomerCart::remove($request, $product);

        return redirect()->route('customer.cart.index')->with('success', 'Product removed from your cart.');
    }
}
