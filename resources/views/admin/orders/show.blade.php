
@extends('layouts.admin')

@section('title', 'Order Details')

@section('page-title', 'Order Details')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Order Details
            </h2>

            <p class="text-muted mb-0">
                {{ $order->order_number }}
            </p>
        </div>

        <a href="{{ route('admin.orders.index') }}"
           class="btn btn-outline-dark">
            ← Back to Orders
        </a>

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


    <div class="row g-4">

        {{-- LEFT SIDE --}}
        <div class="col-lg-8">


            {{-- Order Information --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="fw-bold mb-0">
                        Order Information
                    </h5>

                </div>

                <div class="card-body">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <small class="text-muted">
                                Order Number
                            </small>

                            <div class="fw-bold">
                                {{ $order->order_number }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                Order Date
                            </small>

                            <div class="fw-bold">
                                {{ $order->created_at->format('d M Y, h:i A') }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                Customer
                            </small>

                            <div class="fw-bold">
                                {{ $order->customer_name }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                Email
                            </small>

                            <div class="fw-bold">
                                {{ $order->customer_email }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                Phone
                            </small>

                            <div class="fw-bold">
                                {{ $order->customer_phone ?? 'Not provided' }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                City
                            </small>

                            <div class="fw-bold">
                                {{ $order->city ?? 'Not provided' }}
                            </div>

                        </div>


                        <div class="col-12">

                            <small class="text-muted">
                                Shipping Address
                            </small>

                            <div class="fw-bold">
                                {{ $order->shipping_address }}
                            </div>

                        </div>


                        @if($order->notes)

                            <div class="col-12">

                                <small class="text-muted">
                                    Customer Notes
                                </small>

                                <div class="fw-bold">
                                    {{ $order->notes }}
                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Products --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="fw-bold mb-0">
                        Ordered Products
                    </h5>

                </div>


                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table align-middle">

                            <thead class="table-light">

                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>

                            </thead>


                            <tbody>

                                @foreach($order->items as $item)

                                    <tr>

                                        <td>

                                            <div class="d-flex align-items-center">

                                                @if($item->product && $item->product->main_image)

                                                    <img
                                                        src="{{ asset('storage/' . $item->product->main_image) }}"
                                                        alt="{{ $item->product_name }}"
                                                        width="60"
                                                        height="60"
                                                        style="object-fit: cover; border-radius: 10px;"
                                                        class="me-3"
                                                    >

                                                @else

                                                    <div
                                                        class="me-3 bg-light d-flex align-items-center justify-content-center"
                                                        style="width:60px;height:60px;border-radius:10px;"
                                                    >
                                                        📦
                                                    </div>

                                                @endif


                                                <div>

                                                    <div class="fw-bold">
                                                        {{ $item->product_name }}
                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        <td>
                                            ${{ number_format($item->price, 2) }}
                                        </td>


                                        <td>
                                            {{ $item->quantity }}
                                        </td>


                                        <td>

                                            <strong>
                                                ${{ number_format($item->subtotal, 2) }}
                                            </strong>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        {{-- RIGHT SIDE --}}
        <div class="col-lg-4">


            {{-- Status --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="fw-bold mb-0">
                        Order Status
                    </h5>

                </div>


                <div class="card-body">

                    <form method="POST"
                          action="{{ route('admin.orders.update', $order) }}">

                        @csrf
                        @method('PUT')


                        <label class="form-label fw-bold">
                            Change Status
                        </label>


                        <select name="status"
                                class="form-select mb-3"
                                required>

                            <option value="pending"
                                {{ $order->status === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="processing"
                                {{ $order->status === 'processing' ? 'selected' : '' }}>
                                Processing
                            </option>

                            <option value="shipped"
                                {{ $order->status === 'shipped' ? 'selected' : '' }}>
                                Shipped
                            </option>

                            <option value="delivered"
                                {{ $order->status === 'delivered' ? 'selected' : '' }}>
                                Delivered
                            </option>

                            <option value="cancelled"
                                {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>

                        </select>


                        <button type="submit"
                                class="btn btn-dark w-100">

                            Update Status

                        </button>

                    </form>

                </div>

            </div>


            {{-- Order Summary --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="fw-bold mb-0">
                        Order Summary
                    </h5>

                </div>


                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">

                        <span>
                            Total Items
                        </span>

                        <strong>
                            {{ $order->items->sum('quantity') }}
                        </strong>

                    </div>


                    <hr>


                    <div class="d-flex justify-content-between">

                        <span class="fw-bold">
                            Total Amount
                        </span>

                        <strong class="fs-5">
                            ${{ number_format($order->total_amount, 2) }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<style>

    .card {
        border-radius: 16px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: 1px solid #eee !important;
    }

    .table th {
        white-space: nowrap;
    }

    .form-select {
        border-radius: 10px;
        padding: 11px;
    }

    .btn {
        border-radius: 9px;
    }

</style>

@endsection
