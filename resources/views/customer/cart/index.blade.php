```blade
@extends('layouts.customer')

@section('title', 'My Cart')

@section('content')

<div class="container py-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                🛒 My Cart
            </h2>

            <p class="text-muted mb-0">
                Review your products before placing your order.
            </p>
        </div>

        <a href="{{ route('customer.products.index') }}"
           class="btn btn-outline-primary">
            ← Continue Shopping
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


    {{-- Error Message --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- EMPTY CART --}}
    @if($cartItems->count() === 0)

        <div class="card shadow-sm border-0">

            <div class="card-body text-center py-5">

                <div style="font-size:70px;">
                    🛒
                </div>

                <h3 class="fw-bold mt-3">
                    Your Cart is Empty
                </h3>

                <p class="text-muted">
                    You haven't added any products to your cart yet.
                </p>

                <a href="{{ route('customer.products.index') }}"
                   class="btn btn-primary mt-2">
                    Browse Products
                </a>

            </div>

        </div>

    @else

        <div class="row g-4">

            {{-- CART PRODUCTS --}}
            <div class="col-lg-8">

                <div class="card shadow-sm border-0">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            Cart Products
                        </h5>

                    </div>

                    <div class="card-body p-0">

                        @foreach($cartItems as $item)

                            @php
                                $product = $item->product;

                                $price = (float) $product->price;

                                $quantity = (int) $item->quantity;

                                $subtotal = $price * $quantity;
                            @endphp

                            @if($product)

                                <div class="p-3 border-bottom">

                                    <div class="row align-items-center g-3">

                                        {{-- Product Image --}}
                                        <div class="col-4 col-md-2">

                                            @if($product->main_image)

                                                <img
                                                    src="{{ asset('storage/' . $product->main_image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="img-fluid rounded border"
                                                    style="width:100%; height:100px; object-fit:contain;"
                                                >

                                            @else

                                                <div
                                                    class="bg-light rounded d-flex align-items-center justify-content-center"
                                                    style="height:100px;"
                                                >

                                                    <span class="text-muted small">
                                                        No Image
                                                    </span>

                                                </div>

                                            @endif

                                        </div>


                                        {{-- Product Name --}}
                                        <div class="col-8 col-md-3">

                                            <h6 class="fw-bold mb-1">
                                                {{ $product->name }}
                                            </h6>

                                            @if($product->category)

                                                <small class="text-muted">
                                                    {{ $product->category->name }}
                                                </small>

                                            @endif

                                            <div class="mt-2">

                                                <small class="text-muted">
                                                    SKU:
                                                    {{ $product->sku }}
                                                </small>

                                            </div>

                                        </div>


                                        {{-- Individual Price --}}
                                        <div class="col-6 col-md-2">

                                            <small class="text-muted d-block">
                                                Price
                                            </small>

                                            <strong>
                                                ${{ number_format($price, 2) }}
                                            </strong>

                                        </div>


                                        {{-- Quantity --}}
                                        <div class="col-6 col-md-2">

                                            <small class="text-muted d-block mb-1">
                                                Quantity
                                            </small>

                                            <form
                                                action="{{ route('customer.cart.update', $item) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                @method('PATCH')

                                                <div class="input-group">

                                                    <input
                                                        type="number"
                                                        name="quantity"
                                                        value="{{ $quantity }}"
                                                        min="1"
                                                        max="{{ $product->stock }}"
                                                        class="form-control"
                                                        required
                                                    >

                                                    <button
                                                        type="submit"
                                                        class="btn btn-outline-primary"
                                                        title="Update Quantity"
                                                    >
                                                        ↻
                                                    </button>

                                                </div>

                                            </form>

                                            <small class="text-muted">
                                                Max:
                                                {{ $product->stock }}
                                            </small>

                                        </div>


                                        {{-- Subtotal --}}
                                        <div class="col-6 col-md-2">

                                            <small class="text-muted d-block">
                                                Subtotal
                                            </small>

                                            <strong class="text-primary">
                                                $
                                                {{ number_format($subtotal, 2) }}
                                            </strong>

                                        </div>


                                        {{-- Remove --}}
                                        <div class="col-6 col-md-1 text-md-end">

                                            <form
                                                action="{{ route('customer.cart.destroy', $item) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-outline-danger"
                                                    title="Remove Product"
                                                >
                                                    🗑
                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            @endif

                        @endforeach

                    </div>

                </div>

            </div>


            {{-- ORDER SUMMARY --}}
            <div class="col-lg-4">

                <div class="card shadow-sm border-0">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            Order Summary
                        </h5>

                    </div>

                    <div class="card-body">

                        {{-- Total Products --}}
                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Products
                            </span>

                            <strong>
                                {{ $cartItems->sum('quantity') }}
                            </strong>

                        </div>

                        <hr>


                        {{-- Total --}}
                        <div class="d-flex justify-content-between align-items-center">

                            <span class="fw-bold fs-5">
                                Total
                            </span>

                            <span class="fw-bold fs-4 text-primary">
                                ${{ number_format($total, 2) }}
                            </span>

                        </div>


                        {{-- Checkout Button --}}
                        <div class="d-grid mt-4">

                            <a
                                href="{{ route('customer.checkout') }}"
                                class="btn btn-primary btn-lg"
                            >
                                Proceed to Checkout
                            </a>

                        </div>


                        {{-- Continue Shopping --}}
                        <div class="d-grid mt-3">

                            <a
                                href="{{ route('customer.products.index') }}"
                                class="btn btn-outline-secondary"
                            >
                                Continue Shopping
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    @endif

</div>

@endsection

