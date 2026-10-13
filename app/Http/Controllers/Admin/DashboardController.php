<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $recentOrders = DB::table('orders')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($order) {
                $order->created_at = Carbon::parse($order->created_at);

                return $order;
            });

        return view('admin.dashboard', [
            'productsCount' => DB::table('products')->count(),
            'customersCount' => DB::table('users')->where('role', 'customer')->count(),
            'ordersCount' => DB::table('orders')->count(),
            'categoriesCount' => DB::table('categories')->count(),
            'pendingOrdersCount' => DB::table('orders')->where('status', 'pending')->count(),
            'processingOrdersCount' => DB::table('orders')->where('status', 'processing')->count(),
            'deliveredOrdersCount' => DB::table('orders')->where('status', 'delivered')->count(),
            'totalSales' => DB::table('orders')->where('status', '!=', 'cancelled')->sum('total_amount'),
            'recentOrders' => $recentOrders,
        ]);
    }
}