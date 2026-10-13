<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        return view('admin.reports.index', [
            'totalCustomers' => DB::table('users')->where('role', 'customer')->count(),
            'totalProducts' => DB::table('products')->count(),
            'totalOrders' => DB::table('orders')->count(),
            'totalSales' => DB::table('orders')->where('status', '!=', 'cancelled')->sum('total_amount'),
            'pendingOrders' => DB::table('orders')->where('status', 'pending')->count(),
            'completedOrders' => DB::table('orders')->where('status', 'delivered')->count(),
            'totalQuotations' => DB::table('quotations')->count(),
            'pendingQuotations' => DB::table('quotations')->where('status', 'pending')->count(),
            'totalSupportTickets' => DB::table('support_tickets')->count(),
            'openSupportTickets' => DB::table('support_tickets')->whereIn('status', ['pending', 'in_progress'])->count(),
        ]);
    }
}