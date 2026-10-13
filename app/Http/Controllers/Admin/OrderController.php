<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = DB::table('orders')->orderByDesc('created_at')->paginate(15);
        $orders->getCollection()->transform(function ($order) {
            $order->created_at = Carbon::parse($order->created_at);
            $order->items = DB::table('order_items')->where('order_id', $order->id)->get();

            return $order;
        });

        return view('admin.orders.index', compact('orders'));
    }

    public function show(int $order): View
    {
        $order = $this->findOrder($order);

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, int $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,processing,shipped,delivered,cancelled'],
        ]);

        DB::table('orders')->where('id', $order)->firstOrFail();
        DB::table('orders')->where('id', $order)->update([
            'status' => $validated['status'],
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Order status updated.');
    }

    private function findOrder(int $orderId): object
    {
        $order = DB::table('orders')->where('id', $orderId)->firstOrFail();
        $order->created_at = Carbon::parse($order->created_at);
        $order->updated_at = Carbon::parse($order->updated_at);
        $order->items = DB::table('order_items')->where('order_id', $orderId)->get()->map(function ($item) {
            $item->product = DB::table('products')->where('id', $item->product_id)->first();

            return $item;
        });

        return $order;
    }
}