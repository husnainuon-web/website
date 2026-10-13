<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = DB::table('users')
            ->where('role', 'customer')
            ->orderByDesc('created_at')
            ->paginate(15);

        $customers->getCollection()->transform(function ($customer) {
            $customer->created_at = Carbon::parse($customer->created_at);

            return $customer;
        });

        return view('admin.customers.index', compact('customers'));
    }

    public function show(int $user): View
    {
        $user = DB::table('users')->where('role', 'customer')->where('id', $user)->firstOrFail();
        $user->created_at = Carbon::parse($user->created_at);
        $user->updated_at = Carbon::parse($user->updated_at);

        return view('admin.customers.show', compact('user'));
    }
}