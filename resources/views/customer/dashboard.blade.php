
@extends('layouts.customer')

@section('title', 'Customer Dashboard')

@section('page-title', 'Customer Dashboard')

@section('content')

<div class="container-fluid px-0">

    {{-- =========================
         WELCOME SECTION
    ========================== --}}

    <div class="welcome-card mb-4">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <span class="welcome-badge">
                    <i class="bi bi-stars me-1"></i>
                    Welcome Back
                </span>

                <h2 class="welcome-title">
                    Hello, {{ Auth::user()->name }} 👋
                </h2>

                <p class="welcome-text">
                    Welcome to Zain Manufacturing Customer Portal.
                    Explore our products, manage your wishlist and
                    shopping cart, and discover personalized recommendations.
                </p>

                <a href="{{ route('customer.products.index') }}"
                   class="btn btn-light rounded-3 px-4 fw-semibold browse-btn">

                    <i class="bi bi-shop me-2"></i>
                    Browse Products

                </a>

            </div>

            <div class="col-lg-4 text-center d-none d-lg-block">

                <div class="welcome-icon">
                    <i class="bi bi-building"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         STATISTICS
    ========================== --}}

    <div class="row g-4 mb-4">

        {{-- ORDERS --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-content">

                    <div>

                        <p class="stat-label">
                            My Orders
                        </p>

                        <h3 class="stat-number">
                            {{ $ordersCount }}
                        </h3>

                        <a href="{{ route('customer.orders.index') }}"
                           class="stat-link">

                            View Orders
                            <i class="bi bi-arrow-right ms-1"></i>

                        </a>

                    </div>

                    <div class="stat-icon orders">
                        <i class="bi bi-bag-check"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- WISHLIST --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-content">

                    <div>

                        <p class="stat-label">
                            Wishlist
                        </p>

                        <h3 class="stat-number">
                            {{ $wishlistCount }}
                        </h3>

                        <a href="{{ route('customer.wishlist.index') }}"
                           class="stat-link">

                            View Wishlist
                            <i class="bi bi-arrow-right ms-1"></i>

                        </a>

                    </div>

                    <div class="stat-icon wishlist">
                        <i class="bi bi-heart"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- CART --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-content">

                    <div>

                        <p class="stat-label">
                            Cart Items
                        </p>

                        <h3 class="stat-number">
                            {{ $cartCount }}
                        </h3>

                        <a href="{{ route('customer.cart.index') }}"
                           class="stat-link">

                            View Cart
                            <i class="bi bi-arrow-right ms-1"></i>

                        </a>

                    </div>

                    <div class="stat-icon cart">
                        <i class="bi bi-cart3"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- QUOTATIONS --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="stat-content">

                    <div>

                        <p class="stat-label">
                            Quotations
                        </p>

                        <h3 class="stat-number">
                            0
                        </h3>

                        <a href="{{ route('customer.quotations.index') }}"
                           class="stat-link">

                            View Quotations
                            <i class="bi bi-arrow-right ms-1"></i>

                        </a>

                    </div>

                    <div class="stat-icon quotation">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         RECENT ORDERS + QUICK ACTIONS
    ========================== --}}

    <div class="row g-4">

        {{-- RECENT ORDERS --}}
        <div class="col-lg-8">

            <div class="dashboard-card">

                <div class="card-heading">

                    <div>

                        <h5>
                            Recent Orders
                        </h5>

                        <p>
                            Your latest orders.
                        </p>

                    </div>

                    <a href="{{ route('customer.orders.index') }}"
                       class="view-all">

                        View All

                    </a>

                </div>


                @if($recentOrders->count() > 0)

                    <div class="table-responsive">

                        <table class="table align-middle mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th>Order #</th>

                                    <th>Date</th>

                                    <th>Total</th>

                                    <th>Status</th>

                                    <th class="text-end">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($recentOrders as $order)

                                    <tr>

                                        <td>

                                            <span class="fw-bold">
                                                {{ $order->order_number }}
                                            </span>

                                        </td>

                                        <td>

                                            {{ $order->created_at->format('d M Y') }}

                                            <div class="text-muted small">
                                                {{ $order->created_at->format('h:i A') }}
                                            </div>

                                        </td>

                                        <td>

                                            <span class="fw-semibold">
                                                ${{ number_format($order->total_amount, 2) }}
                                            </span>

                                        </td>

                                        <td>

                                            @if($order->status === 'pending')

                                                <span class="badge bg-warning text-dark">
                                                    Pending
                                                </span>

                                            @elseif($order->status === 'processing')

                                                <span class="badge bg-info text-dark">
                                                    Processing
                                                </span>

                                            @elseif($order->status === 'shipped')

                                                <span class="badge bg-primary">
                                                    Shipped
                                                </span>

                                            @elseif($order->status === 'delivered')

                                                <span class="badge bg-success">
                                                    Delivered
                                                </span>

                                            @elseif($order->status === 'cancelled')

                                                <span class="badge bg-danger">
                                                    Cancelled
                                                </span>

                                            @else

                                                <span class="badge bg-secondary">
                                                    {{ ucfirst($order->status) }}
                                                </span>

                                            @endif

                                        </td>

                                        <td class="text-end">

                                            <a href="{{ route('customer.orders.show', $order) }}"
                                               class="btn btn-sm btn-outline-success">

                                                Details

                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty-state">

                        <div class="empty-icon">
                            <i class="bi bi-bag-x"></i>
                        </div>

                        <h6>
                            No Orders Yet
                        </h6>

                        <p>
                            You haven't placed any orders yet.
                        </p>

                        <a href="{{ route('customer.products.index') }}"
                           class="btn btn-success rounded-3 px-4">

                            <i class="bi bi-shop me-2"></i>
                            Start Shopping

                        </a>

                    </div>

                @endif

            </div>

        </div>


        {{-- QUICK ACTIONS --}}
        <div class="col-lg-4">

            <div class="dashboard-card">

                <div class="card-heading">

                    <div>

                        <h5>
                            Quick Actions
                        </h5>

                        <p>
                            Frequently used options.
                        </p>

                    </div>

                </div>


                <div class="quick-actions">

                    {{-- PRODUCTS --}}
                    <a href="{{ route('customer.products.index') }}"
                       class="quick-action">

                        <div class="quick-action-icon products">
                            <i class="bi bi-shop"></i>
                        </div>

                        <div>

                            <strong>
                                Browse Products
                            </strong>

                            <small>
                                Explore our products
                            </small>

                        </div>

                        <i class="bi bi-chevron-right ms-auto"></i>

                    </a>


                    {{-- WISHLIST --}}
                    <a href="{{ route('customer.wishlist.index') }}"
                       class="quick-action">

                        <div class="quick-action-icon wishlist">
                            <i class="bi bi-heart"></i>
                        </div>

                        <div>

                            <strong>
                                My Wishlist
                            </strong>

                            <small>
                                View saved products
                            </small>

                        </div>

                        <i class="bi bi-chevron-right ms-auto"></i>

                    </a>


                    {{-- CART --}}
                    <a href="{{ route('customer.cart.index') }}"
                       class="quick-action">

                        <div class="quick-action-icon cart">
                            <i class="bi bi-cart3"></i>
                        </div>

                        <div>

                            <strong>
                                Shopping Cart
                            </strong>

                            <small>
                                Review your cart
                            </small>

                        </div>

                        <i class="bi bi-chevron-right ms-auto"></i>

                    </a>


                    {{-- ORDERS --}}
                    <a href="{{ route('customer.orders.index') }}"
                       class="quick-action">

                        <div class="quick-action-icon orders">
                            <i class="bi bi-bag-check"></i>
                        </div>

                        <div>

                            <strong>
                                My Orders
                            </strong>

                            <small>
                                Track your orders
                            </small>

                        </div>

                        <i class="bi bi-chevron-right ms-auto"></i>

                    </a>


                    {{-- QUOTATION --}}
                    <a href="{{ route('customer.quotations.index') }}"
                       class="quick-action">

                        <div class="quick-action-icon quotation">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>

                        <div>

                            <strong>
                                Request Quotation
                            </strong>

                            <small>
                                Ask for a custom quote
                            </small>

                        </div>

                        <i class="bi bi-chevron-right ms-auto"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         ACCOUNT
    ========================== --}}

    <div class="row mt-4">

        <div class="col-12">

            <div class="account-card">

                <div class="d-flex flex-column flex-md-row
                            justify-content-between
                            align-items-md-center
                            gap-3">

                    <div>

                        <h5 class="fw-bold mb-1">

                            <i class="bi bi-person-circle me-2"></i>
                            Account

                        </h5>

                        <p class="text-muted mb-0">

                            Logged in as

                            <strong>
                                {{ Auth::user()->name }}
                            </strong>

                        </p>

                    </div>


                    <form method="POST"
                          action="{{ route('logout') }}">

                        @csrf

                        <button type="submit"
                                class="btn btn-outline-danger rounded-3 px-4">

                            <i class="bi bi-box-arrow-right me-2"></i>
                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================
     DASHBOARD CSS
========================= --}}

<style>

    /* =========================
       GENERAL
    ========================== */

    .welcome-card,
    .stat-card,
    .dashboard-card,
    .account-card {

        transition: all 0.25s ease;

    }


    /* =========================
       WELCOME
    ========================== */

    .welcome-card {

        background: linear-gradient(
            135deg,
            #166534 0%,
            #15803d 55%,
            #22c55e 100%
        );

        border-radius: 20px;
        padding: 40px;
        color: white;
        overflow: hidden;

        box-shadow:
            0 15px 40px rgba(22, 101, 52, 0.18);

    }


    .welcome-badge {

        display: inline-block;

        background: rgba(255,255,255,0.14);

        padding: 8px 15px;

        border-radius: 30px;

        font-size: 12px;

        font-weight: 600;

        margin-bottom: 15px;

        border: 1px solid rgba(255,255,255,0.12);

    }


    .welcome-title {

        font-size: 30px;

        font-weight: 800;

        margin-bottom: 10px;

    }


    .welcome-text {

        color: #ecfdf5;

        max-width: 700px;

        line-height: 1.7;

        margin-bottom: 25px;

    }


    .browse-btn {

        color: #15803d;

        border: none;

        transition: 0.2s ease;

    }


    .browse-btn:hover {

        color: #166534;

        transform: translateY(-2px);

    }


    .welcome-icon {

        width: 150px;

        height: 150px;

        margin: auto;

        border-radius: 50%;

        background: rgba(255,255,255,0.10);

        border: 1px solid rgba(255,255,255,0.15);

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 65px;

    }


    /* =========================
       STATISTICS
    ========================== */

    .stat-card {

        background: white;

        border-radius: 18px;

        padding: 25px;

        border: 1px solid #e5eee8;

        box-shadow:
            0 5px 20px rgba(22, 101, 52, 0.05);

    }


    .stat-card:hover {

        transform: translateY(-4px);

        border-color: #bbf7d0;

        box-shadow:
            0 12px 30px rgba(22, 101, 52, 0.10);

    }


    .stat-content {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

    }


    .stat-label {

        color: #6b7280;

        font-size: 13px;

        margin-bottom: 8px;

    }


    .stat-number {

        font-size: 30px;

        font-weight: 800;

        margin-bottom: 10px;

        color: #14532d;

    }


    .stat-link {

        font-size: 12px;

        color: #16a34a;

        text-decoration: none;

        font-weight: 600;

    }


    .stat-link:hover {

        color: #166534;

    }


    .stat-icon {

        width: 52px;

        height: 52px;

        border-radius: 14px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 23px;

    }


    .stat-icon.orders {

        background: #dcfce7;

        color: #15803d;

    }


    .stat-icon.wishlist {

        background: #ecfdf5;

        color: #16a34a;

    }


    .stat-icon.cart {

        background: #f0fdf4;

        color: #22c55e;

    }


    .stat-icon.quotation {

        background: #dcfce7;

        color: #166534;

    }


    /* =========================
       DASHBOARD CARDS
    ========================== */

    .dashboard-card {

        background: white;

        border-radius: 18px;

        border: 1px solid #e5eee8;

        box-shadow:
            0 5px 20px rgba(22,101,52,0.04);

        overflow: hidden;

    }


    .dashboard-card:hover {

        border-color: #d1fae5;

    }


    .card-heading {

        padding: 25px;

        display: flex;

        justify-content: space-between;

        align-items: center;

        border-bottom: 1px solid #edf5ef;

    }


    .card-heading h5 {

        font-weight: 700;

        margin-bottom: 5px;

        color: #14532d;

    }


    .card-heading p {

        color: #6b7280;

        font-size: 12px;

        margin: 0;

    }


    .view-all {

        text-decoration: none;

        font-size: 13px;

        font-weight: 600;

        color: #16a34a;

    }


    .view-all:hover {

        color: #166534;

    }


    /* =========================
       TABLE
    ========================== */

    .dashboard-card table {

        font-size: 13px;

    }


    .dashboard-card table th {

        font-weight: 600;

        color: #64748b;

        font-size: 12px;

    }


    .dashboard-card table td {

        padding-top: 15px;

        padding-bottom: 15px;

    }


    .dashboard-card table tbody tr:hover {

        background: #f0fdf4;

    }


    /* =========================
       EMPTY STATE
    ========================== */

    .empty-state {

        text-align: center;

        padding: 55px 20px;

    }


    .empty-icon {

        width: 75px;

        height: 75px;

        margin: auto;

        margin-bottom: 20px;

        border-radius: 50%;

        background: #ecfdf5;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 30px;

        color: #16a34a;

    }


    .empty-state h6 {

        font-weight: 700;

        margin-bottom: 8px;

        color: #14532d;

    }


    .empty-state p {

        color: #6b7280;

        font-size: 13px;

        margin-bottom: 20px;

    }


    /* =========================
       QUICK ACTIONS
    ========================== */

    .quick-actions {

        padding: 15px;

    }


    .quick-action {

        display: flex;

        align-items: center;

        gap: 12px;

        padding: 13px;

        border-radius: 12px;

        text-decoration: none;

        color: #212529;

        transition: 0.2s ease;

    }


    .quick-action:hover {

        background: #f0fdf4;

        transform: translateX(3px);

        color: #14532d;

    }


    .quick-action strong {

        display: block;

        font-size: 13px;

    }


    .quick-action small {

        display: block;

        color: #6b7280;

        font-size: 11px;

        margin-top: 3px;

    }


    .quick-action-icon {

        width: 42px;

        height: 42px;

        border-radius: 11px;

        display: flex;

        align-items: center;

        justify-content: center;

    }


    .quick-action-icon.products {

        background: #dcfce7;

        color: #15803d;

    }


    .quick-action-icon.wishlist {

        background: #ecfdf5;

        color: #16a34a;

    }


    .quick-action-icon.cart {

        background: #f0fdf4;

        color: #22c55e;

    }


    .quick-action-icon.orders {

        background: #dcfce7;

        color: #166534;

    }


    .quick-action-icon.quotation {

        background: #d1fae5;

        color: #047857;

    }


    /* =========================
       ACCOUNT
    ========================== */

    .account-card {

        background: white;

        border-radius: 18px;

        border: 1px solid #e5eee8;

        box-shadow:
            0 5px 20px rgba(22,101,52,0.04);

        padding: 25px;

    }


    .account-card h5 {

        color: #14532d;

    }


    .account-card h5 i {

        color: #16a34a;

    }


    /* =========================
       BUTTONS
    ========================== */

    .btn-success {

        background: #16a34a;

        border-color: #16a34a;

    }


    .btn-success:hover {

        background: #15803d;

        border-color: #15803d;

    }


    .btn-outline-success {

        color: #16a34a;

        border-color: #16a34a;

    }


    .btn-outline-success:hover {

        background: #16a34a;

        border-color: #16a34a;

        color: white;

    }


    /* =========================
       MOBILE
    ========================== */

    @media (max-width: 768px) {

        .welcome-card {

            padding: 25px;

            border-radius: 16px;

        }


        .welcome-title {

            font-size: 24px;

        }


        .welcome-text {

            font-size: 14px;

        }


        .stat-card {

            padding: 20px;

        }


        .card-heading {

            padding: 20px;

        }

    }

</style>

@endsection

