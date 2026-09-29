@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Reports
            </h2>

            <p class="text-muted mb-0">
                Overview of your Spotlite business activity.
            </p>
        </div>

        <span class="badge bg-primary px-3 py-2">
            Admin Reports
        </span>

    </div>


    {{-- Main Statistics --}}
    <div class="row g-4 mb-4">

        {{-- Customers --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Total Customers
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ $totalCustomers }}
                            </h2>
                        </div>

                        <div class="bg-primary text-white rounded-circle
                                    d-flex align-items-center justify-content-center"
                             style="width:55px;height:55px;font-size:24px;">
                            👥
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Products --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Total Products
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ $totalProducts }}
                            </h2>
                        </div>

                        <div class="bg-success text-white rounded-circle
                                    d-flex align-items-center justify-content-center"
                             style="width:55px;height:55px;font-size:24px;">
                            📦
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
                            <p class="text-muted mb-1">
                                Total Orders
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ $totalOrders }}
                            </h2>
                        </div>

                        <div class="bg-warning text-dark rounded-circle
                                    d-flex align-items-center justify-content-center"
                             style="width:55px;height:55px;font-size:24px;">
                            🛒
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Sales --}}
        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Total Sales
                            </p>

                            <h2 class="fw-bold mb-0">
                                ${{ number_format($totalSales, 2) }}
                            </h2>
                        </div>

                        <div class="bg-dark text-white rounded-circle
                                    d-flex align-items-center justify-content-center"
                             style="width:55px;height:55px;font-size:24px;">
                            💰
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Orders / Quotations / Support --}}
    <div class="row g-4 mb-4">

        {{-- Orders Report --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white py-3">

                    <h5 class="fw-bold mb-0">
                        Orders Report
                    </h5>

                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between
                                border-bottom pb-3 mb-3">

                        <span class="text-muted">
                            Total Orders
                        </span>

                        <strong>
                            {{ $totalOrders }}
                        </strong>

                    </div>


                    <div class="d-flex justify-content-between
                                border-bottom pb-3 mb-3">

                        <span class="text-muted">
                            Pending Orders
                        </span>

                        <span class="badge bg-warning text-dark">
                            {{ $pendingOrders }}
                        </span>

                    </div>


                    <div class="d-flex justify-content-between">

                        <span class="text-muted">
                            Completed Orders
                        </span>

                        <span class="badge bg-success">
                            {{ $completedOrders }}
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- Quotations Report --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white py-3">

                    <h5 class="fw-bold mb-0">
                        Quotations Report
                    </h5>

                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between
                                border-bottom pb-3 mb-3">

                        <span class="text-muted">
                            Total Quotations
                        </span>

                        <strong>
                            {{ $totalQuotations }}
                        </strong>

                    </div>


                    <div class="d-flex justify-content-between">

                        <span class="text-muted">
                            Pending Quotations
                        </span>

                        <span class="badge bg-warning text-dark">
                            {{ $pendingQuotations }}
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- Support Report --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white py-3">

                    <h5 class="fw-bold mb-0">
                        Support Report
                    </h5>

                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between
                                border-bottom pb-3 mb-3">

                        <span class="text-muted">
                            Total Tickets
                        </span>

                        <strong>
                            {{ $totalSupportTickets }}
                        </strong>

                    </div>


                    <div class="d-flex justify-content-between">

                        <span class="text-muted">
                            Open / Pending
                        </span>

                        <span class="badge bg-danger">
                            {{ $openSupportTickets }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Business Summary --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <h5 class="fw-bold mb-0">
                Business Summary
            </h5>

        </div>

        <div class="card-body">

            <div class="row text-center">

                <div class="col-md-3 mb-3 mb-md-0">

                    <h4 class="fw-bold text-primary">
                        {{ $totalCustomers }}
                    </h4>

                    <p class="text-muted mb-0">
                        Customers
                    </p>

                </div>


                <div class="col-md-3 mb-3 mb-md-0">

                    <h4 class="fw-bold text-success">
                        {{ $totalProducts }}
                    </h4>

                    <p class="text-muted mb-0">
                        Products
                    </p>

                </div>


                <div class="col-md-3 mb-3 mb-md-0">

                    <h4 class="fw-bold text-warning">
                        {{ $totalOrders }}
                    </h4>

                    <p class="text-muted mb-0">
                        Orders
                    </p>

                </div>


                <div class="col-md-3">

                    <h4 class="fw-bold text-dark">
                        ${{ number_format($totalSales, 2) }}
                    </h4>

                    <p class="text-muted mb-0">
                        Completed Sales
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection