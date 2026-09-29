
@extends('layouts.customer')

@section('title', 'My Orders')

@section('page-title', 'My Orders')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="mb-4">

        <h2 class="fw-bold mb-1">
            My Orders
        </h2>

        <p class="text-muted mb-0">
            View and track all your orders.
        </p>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success shadow-sm border-0">
            {{ session('success') }}
        </div>

    @endif


    {{-- Error Message --}}
    @if(session('error'))

        <div class="alert alert-danger shadow-sm border-0">
            {{ session('error') }}
        </div>

    @endif


    @if($orders->count() > 0)

        {{-- Orders Card --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="px-4 py-3">
                                    Order #
                                </th>

                                <th>
                                    Date
                                </th>

                                <th>
                                    Items
                                </th>

                                <th>
                                    Total
                                </th>

                                <th>
                                    Status
                                </th>

                                <th class="text-end px-4">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($orders as $order)

                                <tr>

                                    {{-- Order Number --}}
                                    <td class="px-4">

                                        <span class="fw-bold">
                                            {{ $order->order_number }}
                                        </span>

                                    </td>


                                    {{-- Date --}}
                                    <td>

                                        {{ $order->created_at->format('d M Y') }}

                                        <div class="text-muted small">
                                            {{ $order->created_at->format('h:i A') }}
                                        </div>

                                    </td>


                                    {{-- Items --}}
                                    <td>

                                        {{ $order->items->sum('quantity') }}

                                        {{ $order->items->sum('quantity') == 1 ? 'Item' : 'Items' }}

                                    </td>


                                    {{-- Total --}}
                                    <td>

                                        <span class="fw-bold text-primary">
                                            ${{ number_format($order->total_amount, 2) }}
                                        </span>

                                    </td>


                                    {{-- Status --}}
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


                                    {{-- Action --}}
                                    <td class="text-end px-4">

                                        <a
                                            href="{{ route('customer.orders.show', $order) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            View Details
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- Pagination --}}
        <div class="mt-4">

            {{ $orders->links() }}

        </div>


    @else

        {{-- Empty Orders --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <div
                    class="mb-3"
                    style="font-size: 65px;"
                >
                    📦
                </div>

                <h4 class="fw-bold mt-3">
                    No Orders Yet
                </h4>

                <p class="text-muted mb-4">
                    You haven't placed any orders yet.
                </p>

                <a
                    href="{{ route('customer.products.index') }}"
                    class="btn btn-primary px-4"
                >
                    Browse Products
                </a>

            </div>

        </div>

    @endif

</div>

@endsection
