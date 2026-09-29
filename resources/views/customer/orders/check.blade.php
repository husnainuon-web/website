
@extends('layouts.app')

@section('content')

<div class="container py-5">

    {{-- Page Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            Checkout
        </h2>

        <p class="text-muted mb-0">
            Review your order and provide your delivery information.
        </p>
    </div>


    {{-- Error Messages --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row g-4">

        {{-- Customer Information --}}
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Delivery Information
                    </h4>

                    <form
                        action="{{ route('customer.checkout.store') }}"
                        method="POST"
                    >

                        @csrf


                        {{-- Name --}}
                        <div class="mb-3">

                            <label
                                for="customer_name"
                                class="form-label fw-semibold"
                            >
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="customer_name"
                                id="customer_name"
                                class="form-control"
                                value="{{ old('customer_name', auth()->user()->name) }}"
                                placeholder="Enter your full name"
                                required
                            >

                        </div>


                        {{-- Email --}}
                        <div class="mb-3">

                            <label
                                for="customer_email"
                                class="form-label fw-semibold"
                            >
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="customer_email"
                                id="customer_email"
                                class="form-control"
                                value="{{ old('customer_email', auth()->user()->email) }}"
                                placeholder="Enter your email"
                                required
                            >

                        </div>


                        {{-- Phone --}}
                        <div class="mb-3">

                            <label
                                for="customer_phone"
                                class="form-label fw-semibold"
                            >
                                Phone Number
                            </label>

                            <input
                                type="text"
                                name="customer_phone"
                                id="customer_phone"
                                class="form-control"
                                value="{{ old('customer_phone') }}"
                                placeholder="03XX-XXXXXXX"
                            >

                        </div>


                        {{-- Address --}}
                        <div class="mb-3">

                            <label
                                for="shipping_address"
                                class="form-label fw-semibold"
                            >
                                Shipping Address
                            </label>

                            <textarea
                                name="shipping_address"
                                id="shipping_address"
                                rows="4"
                                class="form-control"
                                placeholder="Enter your complete delivery address"
                                required
                            >{{ old('shipping_address') }}</textarea>

                        </div>


                        {{-- City --}}
                        <div class="mb-3">

                            <label
                                for="city"
                                class="form-label fw-semibold"
                            >
                                City
                            </label>

                            <input
                                type="text"
                                name="city"
                                id="city"
                                class="form-control"
                                value="{{ old('city') }}"
                                placeholder="Enter your city"
                            >

                        </div>


                        {{-- Notes --}}
                        <div class="mb-4">

                            <label
                                for="notes"
                                class="form-label fw-semibold"
                            >
                                Order Notes
                                <span class="text-muted fw-normal">
                                    (Optional)
                                </span>
                            </label>

                            <textarea
                                name="notes"
                                id="notes"
                                rows="3"
                                class="form-control"
                                placeholder="Any special instructions?"
                            >{{ old('notes') }}</textarea>

                        </div>


                        <div class="alert alert-info mb-3">
                            <strong>Do you want to order this product?</strong><br>
                            If you click <strong>Place Order</strong>, your order will be sent to the admin for processing.
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('customer.cart.index') }}"
                                class="btn btn-outline-secondary"
                            >
                                ← Back to Cart
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary flex-grow-1"
                            >
                                Place Order
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- Order Summary --}}
        <div class="col-lg-5">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Order Summary
                    </h4>


                    {{-- Cart Items --}}
                    @foreach($cartItems as $item)

                        @if($item->product)

                            <div class="d-flex align-items-center mb-3">

                                {{-- Product Image --}}
                                <div
                                    class="me-3"
                                    style="width:70px; height:70px;"
                                >

                                    @if($item->product->main_image)

                                        <img
                                            src="{{ asset('storage/' . $item->product->main_image) }}"
                                            alt="{{ $item->product->name }}"
                                            class="rounded"
                                            style="
                                                width:70px;
                                                height:70px;
                                                object-fit:cover;
                                            "
                                        >

                                    @else

                                        <div
                                            class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="
                                                width:70px;
                                                height:70px;
                                            "
                                        >
                                            <span class="text-muted small">
                                                No Image
                                            </span>
                                        </div>

                                    @endif

                                </div>


                                {{-- Product Information --}}
                                <div class="flex-grow-1">

                                    <h6 class="fw-bold mb-1">
                                        {{ $item->product->name }}
                                    </h6>

                                    <div class="text-muted small">
                                        Quantity: {{ $item->quantity }}
                                    </div>

                                </div>


                                {{-- Subtotal --}}
                                <div class="fw-bold">

                                    $
                                    {{ number_format(
                                        $item->product->price * $item->quantity,
                                        2
                                    ) }}

                                </div>

                            </div>

                        @endif

                    @endforeach


                    <hr>


                    {{-- Total --}}
                    <div class="d-flex justify-content-between align-items-center">

                        <span class="fw-bold fs-5">
                            Total
                        </span>

                        <span class="fw-bold text-primary fs-4">
                            ${{ number_format($total, 2) }}
                        </span>

                    </div>


                    <div class="alert alert-info mt-4 mb-0">

                        <small>
                            Your order will initially be placed as
                            <strong>Pending</strong>.
                            The admin will process your order.
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

