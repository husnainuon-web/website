@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                AI Recommendation Management
            </h2>

            <p class="text-muted mb-0">
                Monitor customer product views and recommendation activity.
            </p>
        </div>

        <span class="badge bg-primary px-3 py-2">
            AI Recommendations
        </span>

    </div>


    {{-- Statistics --}}
    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <p class="text-muted mb-1">
                        Total Product Views
                    </p>

                    <h2 class="fw-bold mb-0">
                        {{ $totalViews }}
                    </h2>

                    <small class="text-muted">
                        Customer viewing activity
                    </small>

                </div>
            </div>
        </div>


        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <p class="text-muted mb-1">
                        Active Customers
                    </p>

                    <h2 class="fw-bold mb-0">
                        {{ $activeCustomers }}
                    </h2>

                    <small class="text-muted">
                        Customers with viewed products
                    </small>

                </div>
            </div>
        </div>


        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <p class="text-muted mb-1">
                        Products Viewed
                    </p>

                    <h2 class="fw-bold mb-0">
                        {{ $viewedProducts }}
                    </h2>

                    <small class="text-muted">
                        Different products viewed
                    </small>

                </div>
            </div>
        </div>


        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <p class="text-muted mb-1">
                        Active Products
                    </p>

                    <h2 class="fw-bold mb-0">
                        {{ $totalProducts }}
                    </h2>

                    <small class="text-muted">
                        Available for recommendations
                    </small>

                </div>
            </div>
        </div>

    </div>


    {{-- Most Viewed Products --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">

            <h5 class="fw-bold mb-1">
                Most Viewed Products
            </h5>

            <small class="text-muted">
                Products receiving the highest customer interest.
            </small>

        </div>

        <div class="card-body p-0">

            @if($mostViewedProducts->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Views</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($mostViewedProducts as $item)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        @if($item->product)
                                            <strong>
                                                {{ $item->product->name }}
                                            </strong>
                                        @else
                                            <span class="text-muted">
                                                Product removed
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($item->product && $item->product->category)
                                            <span class="badge bg-light text-dark">
                                                {{ $item->product->category->name }}
                                            </span>
                                        @else
                                            <span class="text-muted">
                                                —
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $item->view_count }}
                                        </span>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="p-4 text-center text-muted">
                    No product views available yet.
                </div>

            @endif

        </div>

    </div>


    {{-- Popular Categories --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">

            <h5 class="fw-bold mb-1">
                Popular Product Categories
            </h5>

            <small class="text-muted">
                Categories based on customer viewing activity.
            </small>

        </div>

        <div class="card-body p-0">

            @if($popularCategories->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Total Views</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($popularCategories as $category)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $category->name }}
                                        </strong>
                                    </td>

                                    <td>
                                        <span class="badge bg-success">
                                            {{ $category->view_count }}
                                        </span>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="p-4 text-center text-muted">
                    No category viewing data available yet.
                </div>

            @endif

        </div>

    </div>


    {{-- Recent Customer Activity --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <h5 class="fw-bold mb-1">
                Recent Customer Activity
            </h5>

            <small class="text-muted">
                Latest products viewed by customers.
            </small>

        </div>

        <div class="card-body p-0">

            @if($recentViews->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Viewed At</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($recentViews as $view)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>

                                        @if($view->user)

                                            <strong>
                                                {{ $view->user->name }}
                                            </strong>

                                            <br>

                                            <small class="text-muted">
                                                {{ $view->user->email }}
                                            </small>

                                        @else

                                            <span class="text-muted">
                                                Customer removed
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        @if($view->product)

                                            {{ $view->product->name }}

                                        @else

                                            <span class="text-muted">
                                                Product removed
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        @if($view->product && $view->product->category)

                                            {{ $view->product->category->name }}

                                        @else

                                            —

                                        @endif

                                    </td>

                                    <td>

                                        <small class="text-muted">
                                            {{ $view->created_at?->format('d M Y, h:i A') }}
                                        </small>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="p-4 text-center text-muted">
                    No customer activity available yet.
                </div>

            @endif

        </div>

    </div>

</div>

@endsection