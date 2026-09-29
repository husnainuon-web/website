
@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('page-title', 'Admin Dashboard')

@section('content')

<div class="container-fluid">

    {{-- Welcome --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-1">
            Welcome back, {{ Auth::user()->name }}
        </h4>

        <p class="text-muted mb-0">
            Manage your Spital Sport store from here.
        </p>
    </div>


    {{-- =========================
         STATISTICS
    ========================== --}}

    <div class="row g-4 mb-4">


        {{-- Products --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted small mb-1">
                                Total Products
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $productsCount }}
                            </h3>

                        </div>

                        <div class="bg-dark text-white rounded-3 p-3">

                            <i class="bi bi-box-seam fs-4"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Customers --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted small mb-1">
                                Customers
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $customersCount }}
                            </h3>

                        </div>

                        <div class="bg-dark text-white rounded-3 p-3">

                            <i class="bi bi-people fs-4"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Orders --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted small mb-1">
                                Total Orders
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $ordersCount }}
                            </h3>

                        </div>

                        <div class="bg-dark text-white rounded-3 p-3">

                            <i class="bi bi-cart-check fs-4"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Categories --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted small mb-1">
                                Categories
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $categoriesCount }}
                            </h3>

                        </div>

                        <div class="bg-dark text-white rounded-3 p-3">

                            <i class="bi bi-grid-3x3-gap fs-4"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         ORDER STATUS CARDS
    ========================== --}}

    <div class="row g-4 mb-4">


        {{-- Pending --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                Pending Orders
                            </p>

                            <h4 class="fw-bold mb-0">
                                {{ $pendingOrdersCount }}
                            </h4>

                        </div>

                        <div class="status-icon pending">
                            <i class="bi bi-clock-history"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Processing --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                Processing Orders
                            </p>

                            <h4 class="fw-bold mb-0">
                                {{ $processingOrdersCount }}
                            </h4>

                        </div>

                        <div class="status-icon processing">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Delivered --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                Delivered Orders
                            </p>

                            <h4 class="fw-bold mb-0">
                                {{ $deliveredOrdersCount }}
                            </h4>

                        </div>

                        <div class="status-icon delivered">
                            <i class="bi bi-check-circle"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         SALES
    ========================== --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <p class="text-muted small mb-1">
                        Total Sales
                    </p>

                    <h3 class="fw-bold mb-0">
                        ${{ number_format($totalSales, 2) }}
                    </h3>

                </div>

                <div class="bg-dark text-white rounded-3 p-3">

                    <i class="bi bi-currency-rupee fs-4"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         MAIN DASHBOARD
    ========================== --}}

    <div class="row g-4">


        {{-- Recent Orders --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Recent Orders
                            </h5>

                            <p class="text-muted small mb-0">
                                Latest customer orders
                            </p>

                        </div>

                        <a
                            href="{{ route('admin.orders.index') }}"
                            class="btn btn-sm btn-outline-dark"
                        >
                            View All
                        </a>

                    </div>

                </div>


                <div class="card-body p-4">

                    @if($recentOrders->count() > 0)

                        <div class="table-responsive">

                            <table class="table align-middle">

                                <thead>

                                    <tr>

                                        <th>
                                            Order
                                        </th>

                                        <th>
                                            Customer
                                        </th>

                                        <th>
                                            Total
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th>
                                            Action
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach($recentOrders as $order)

                                        <tr>

                                            <td>

                                                <strong>
                                                    {{ $order->order_number }}
                                                </strong>

                                                <small class="text-muted d-block">
                                                    {{ $order->created_at->format('d M Y') }}
                                                </small>

                                            </td>


                                            <td>

                                                {{ $order->customer_name }}

                                                <small class="text-muted d-block">
                                                    {{ $order->customer_email }}
                                                </small>

                                            </td>


                                            <td>

                                                <strong>
                                                    ${{ number_format($order->total_amount, 2) }}
                                                </strong>

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

                                                @endif

                                            </td>


                                            <td>

                                                <a
                                                    href="{{ route('admin.orders.show', $order) }}"
                                                    class="btn btn-sm btn-dark"
                                                >
                                                    View
                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="text-center py-5">

                            <div class="mb-3">

                                <i class="bi bi-inbox fs-1 text-muted"></i>

                            </div>

                            <h6 class="fw-bold">
                                No orders yet
                            </h6>

                            <p class="text-muted small mb-0">
                                Customer orders will appear here.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- Quick Actions --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h5 class="fw-bold mb-1">
                        Quick Actions
                    </h5>

                    <p class="text-muted small mb-0">
                        Manage your store
                    </p>

                </div>


                <div class="card-body p-4">


                    {{-- Add Product --}}
                    <a
                        href="{{ route('admin.products.create') }}"
                        class="btn btn-dark w-100 mb-3"
                    >

                        <i class="bi bi-plus-lg me-2"></i>

                        Add Product

                    </a>


                    {{-- Add Category --}}
                    <a
                        href="{{ route('admin.categories.create') }}"
                        class="btn btn-outline-dark w-100 mb-3"
                    >

                        <i class="bi bi-folder-plus me-2"></i>

                        Add Category

                    </a>


                    {{-- View Orders --}}
                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="btn btn-outline-dark w-100"
                    >

                        <i class="bi bi-cart3 me-2"></i>

                        View Orders

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         SYSTEM INFORMATION
    ========================== --}}

    <div class="card border-0 shadow-sm mt-4">

        <div class="card-body p-4">

            <div class="d-flex align-items-center mb-3">

                <i class="bi bi-info-circle fs-4 me-3"></i>

                <div>

                    <h6 class="fw-bold mb-1">
                        System Information
                    </h6>

                    <p class="text-muted small mb-0">
                        Spital Sport Admin Panel
                    </p>

                </div>

            </div>


            <div class="row">

                <div class="col-md-4 mb-3 mb-md-0">

                    <small class="text-muted d-block">
                        Logged in as
                    </small>

                    <strong>
                        {{ Auth::user()->email }}
                    </strong>

                </div>


                <div class="col-md-4 mb-3 mb-md-0">

                    <small class="text-muted d-block">
                        Role
                    </small>

                    <strong>
                        Administrator
                    </strong>

                </div>


                <div class="col-md-4">

                    <small class="text-muted d-block">
                        Status
                    </small>

                    <span class="badge bg-success">
                        Active
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>


<style>

    .status-icon {
        width: 45px;
        height: 45px;

        border-radius: 12px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #f3f4f6;

        color: #111827;

        font-size: 20px;
    }


    .table th {
        font-size: 13px;
        color: #6b7280;
        font-weight: 600;
        border-bottom: 1px solid #e5e7eb;
    }


    .table td {
        padding-top: 14px;
        padding-bottom: 14px;
    }


    .badge {
        padding: 7px 10px;
        border-radius: 8px;
    }


    .card {
        border-radius: 16px;
    }


    .btn {
        border-radius: 9px;
    }

</style>

@endsection

