
@extends('layouts.admin')

@section('title', 'Customer Orders')

@section('page-title', 'Customer Orders')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Customer Orders</h2>
            <p class="text-muted mb-0">
                Manage all customer orders.
            </p>
        </div>

        <div class="bg-dark text-white px-3 py-2 rounded-3">
            Total Orders: {{ $orders->total() }}
        </div>
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- Orders --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0 fw-bold">
                All Orders
            </h5>
        </div>

        <div class="card-body">

            @if($orders->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($orders as $order)

                                <tr>

                                    <td>
                                        {{ $orders->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $order->order_number }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $order->customer_name }}
                                    </td>

                                    <td>
                                        {{ $order->customer_email }}
                                    </td>

                                    <td>
                                        {{ $order->items->sum('quantity') }}
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
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>

                                    <td>

                                        <a href="{{ route('admin.orders.show', $order) }}"
                                           class="btn btn-sm btn-dark">
                                            View
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>

            @else

                <div class="text-center py-5">

                    <div style="font-size: 60px;">
                        📦
                    </div>

                    <h4 class="fw-bold mt-3">
                        No Orders Yet
                    </h4>

                    <p class="text-muted">
                        Customer orders will appear here when customers place orders.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>


<style>

    .card {
        border-radius: 16px;
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        white-space: nowrap;
    }

    .table td {
        vertical-align: middle;
    }

    .badge {
        padding: 7px 10px;
        border-radius: 8px;
    }

    .btn-dark {
        border-radius: 8px;
    }

</style>

@endsection

