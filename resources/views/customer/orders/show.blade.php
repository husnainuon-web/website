
@extends('layouts.app')

@section('content')

<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Order Details
            </h2>

            <p class="text-muted mb-0">
                Order #{{ $order->order_number }}
            </p>
        </div>

        <a
            href="{{ route('customer.orders.index') }}"
            class="btn btn-outline-secondary"
        >
            ← Back to My Orders
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="row g-4">

        {{-- Order Information --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h4 class="fw-bold mb-0">
                            Ordered Products
                        </h4>

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

                    </div>


                    {{-- Products --}}
                    @foreach($order->items as $item)

                        <div class="d-flex align-items-center border-bottom py-3">

                            {{-- Image --}}
                            <div
                                class="me-3"
                                style="width:80px; height:80px;"
                            >

                                @if($item->product && $item->product->main_image)

                                    <img
                                        src="{{ asset('storage/' . $item->product->main_image) }}"
                                        alt="{{ $item->product_name }}"
                                        class="rounded"
                                        style="
                                            width:80px;
                                            height:80px;
                                            object-fit:cover;
                                        "
                                    >

                                @else

                                    <div
                                        class="bg-light rounded d-flex align-items-center justify-content-center"
                                        style="
                                            width:80px;
                                            height:80px;
                                        "
                                    >
                                        <span class="text-muted small">
                                            No Image
                                        </span>
                                    </div>

                                @endif

                            </div>


                            {{-- Product --}}
                            <div class="flex-grow-1">

                                <h6 class="fw-bold mb-1">
                                    {{ $item->product_name }}
                                </h6>

                                <div class="text-muted small">
                                    Quantity: {{ $item->quantity }}
                                </div>

                                <div class="text-muted small">
                                    Price: ${{ number_format($item->price, 2) }}
                                </div>

                            </div>


                            {{-- Subtotal --}}
                            <div class="text-end">

                                <div class="fw-bold">
                                    ${{ number_format($item->subtotal, 2) }}
                                </div>

                            </div>

                        </div>

                    @endforeach


                    {{-- Total --}}
                    <div class="d-flex justify-content-between align-items-center mt-4">

                        <span class="fw-bold fs-5">
                            Total
                        </span>

                        <span class="fw-bold text-primary fs-4">
                            ${{ number_format($order->total_amount, 2) }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- Customer / Delivery Information --}}
            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Delivery Information
                    </h4>

                    <div class="row g-3">

                        <div class="col-md-6">

                            <div class="text-muted small">
                                Customer Name
                            </div>

                            <div class="fw-semibold">
                                {{ $order->customer_name }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="text-muted small">
                                Email
                            </div>

                            <div class="fw-semibold">
                                {{ $order->customer_email }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="text-muted small">
                                Phone
                            </div>

                            <div class="fw-semibold">
                                {{ $order->customer_phone ?: 'Not provided' }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="text-muted small">
                                City
                            </div>

                            <div class="fw-semibold">
                                {{ $order->city ?: 'Not provided' }}
                            </div>

                        </div>


                        <div class="col-12">

                            <div class="text-muted small">
                                Shipping Address
                            </div>

                            <div class="fw-semibold">
                                {{ $order->shipping_address }}
                            </div>

                        </div>


                        @if($order->notes)

                            <div class="col-12">

                                <div class="text-muted small">
                                    Order Notes
                                </div>

                                <div class="fw-semibold">
                                    {{ $order->notes }}
                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- Order Summary --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Order Summary
                    </h4>


                    <div class="mb-3">

                        <div class="text-muted small">
                            Order Number
                        </div>

                        <div class="fw-bold">
                            {{ $order->order_number }}
                        </div>

                    </div>


                    <div class="mb-3">

                        <div class="text-muted small">
                            Order Date
                        </div>

                        <div class="fw-semibold">
                            {{ $order->created_at->format('d M Y, h:i A') }}
                        </div>

                    </div>


                    <div class="mb-3">

                        <div class="text-muted small">
                            Order Status
                        </div>

                        <div class="fw-semibold">
                            {{ ucfirst($order->status) }}
                        </div>

                    </div>


                    <hr>


                    <div class="d-flex justify-content-between">

                        <span>
                            Total Items
                        </span>

                        <strong>
                            {{ $order->items->sum('quantity') }}
                        </strong>

                    </div>


                    <div class="d-flex justify-content-between mt-2">

                        <span>
                            Total Amount
                        </span>

                        <strong class="text-primary">
                            PKR {{ number_format($order->total_amount, 2) }}
                        </strong>

                    </div>


                    <hr>


                    <div class="alert alert-info mb-0">

                        <small>
                            Your order is currently
                            <strong>{{ ucfirst($order->status) }}</strong>.
                            You can check this page anytime for the latest
                            order status.
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
