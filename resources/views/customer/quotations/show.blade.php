
@extends('layouts.customer')

@section('title', 'Quotation Details')

@section('page-title', 'Quotation Details')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">

        <a href="{{ route('customer.quotations.index') }}"
           class="text-decoration-none text-muted">

            <i class="bi bi-arrow-left me-1"></i>
            Back to Quotations

        </a>

        <h2 class="fw-bold mt-3 mb-1">
            Quotation #{{ $quotation->id }}
        </h2>

        <p class="text-muted mb-0">
            Submitted on
            {{ $quotation->created_at->format('d M Y, h:i A') }}
        </p>

    </div>


    <div class="row g-4">

        {{-- Product Information --}}
        <div class="col-lg-5">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h5 class="fw-bold mb-3">
                        Product
                    </h5>


                    @if($quotation->product)

                        {{-- Product Image --}}
                        @if(
                            $quotation->product->images &&
                            $quotation->product->images->count() > 0
                        )

                            <img
                                src="{{ asset('storage/' . $quotation->product->images->first()->image) }}"
                                alt="{{ $quotation->product->name }}"
                                class="img-fluid rounded mb-3"
                                style="width:100%; height:250px; object-fit:cover;"
                            >

                        @else

                            <div
                                class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                                style="height:250px;"
                            >

                                <span style="font-size:60px;">
                                    📦
                                </span>

                            </div>

                        @endif


                        {{-- Product Name --}}
                        <h4 class="fw-bold">
                            {{ $quotation->product->name }}
                        </h4>


                        {{-- Category --}}
                        @if($quotation->product->category)

                            <p class="text-muted">

                                <i class="bi bi-tag me-1"></i>

                                {{ $quotation->product->category->name }}

                            </p>

                        @endif


                        {{-- View Product --}}
                        <a
                            href="{{ route('customer.products.show', $quotation->product) }}"
                            class="btn btn-outline-dark btn-sm"
                        >

                            <i class="bi bi-eye me-1"></i>

                            View Product

                        </a>

                    @else

                        <p class="text-muted mb-0">
                            This product is no longer available.
                        </p>

                    @endif

                </div>

            </div>

        </div>


        {{-- Quotation Details --}}
        <div class="col-lg-7">


            {{-- Status Card --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Quotation Status
                            </h5>

                            <p class="text-muted mb-0">
                                Current status of your request
                            </p>

                        </div>


                        <div>

                            @if($quotation->status === 'pending')

                                <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                                    Pending
                                </span>

                            @elseif($quotation->status === 'approved')

                                <span class="badge bg-success fs-6 px-3 py-2">
                                    Approved
                                </span>

                            @elseif($quotation->status === 'rejected')

                                <span class="badge bg-danger fs-6 px-3 py-2">
                                    Rejected
                                </span>

                            @else

                                <span class="badge bg-secondary fs-6 px-3 py-2">
                                    {{ ucfirst($quotation->status) }}
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- Request Details --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body">

                    <h5 class="fw-bold mb-4">
                        Your Request
                    </h5>


                    {{-- Product --}}
                    <div class="row mb-3">

                        <div class="col-sm-5 text-muted">
                            Product
                        </div>

                        <div class="col-sm-7 fw-semibold">
                            {{ $quotation->product->name ?? 'Product Deleted' }}
                        </div>

                    </div>


                    {{-- Quantity --}}
                    <div class="row mb-3">

                        <div class="col-sm-5 text-muted">
                            Required Quantity
                        </div>

                        <div class="col-sm-7 fw-semibold">
                            {{ number_format($quotation->quantity) }}
                        </div>

                    </div>


                    {{-- Submitted Date --}}
                    <div class="row mb-3">

                        <div class="col-sm-5 text-muted">
                            Submitted Date
                        </div>

                        <div class="col-sm-7">
                            {{ $quotation->created_at->format('d M Y, h:i A') }}
                        </div>

                    </div>


                    {{-- Customer Message --}}
                    @if($quotation->message)

                        <div class="mt-4">

                            <label class="text-muted mb-2">
                                Additional Requirements
                            </label>

                            <div class="bg-light rounded p-3">

                                {{ $quotation->message }}

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- Admin Response --}}
            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h5 class="fw-bold mb-4">
                        Admin Response
                    </h5>


                    {{-- Quoted Price --}}
                    @if($quotation->quoted_price !== null)

                        <div class="alert alert-success">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <strong>
                                        Quoted Price
                                    </strong>

                                    <p class="mb-0 text-muted">
                                        Price provided by Zain Manufacturing
                                    </p>

                                </div>


                                <div class="fs-4 fw-bold">

                                    $
                                    {{ number_format($quotation->quoted_price, 2) }}

                                </div>

                            </div>

                        </div>

                    @else

                        <div class="alert alert-warning">

                            <i class="bi bi-clock me-2"></i>

                            Your quotation has not been priced yet.
                            Please wait for the admin response.

                        </div>

                    @endif


                    {{-- Admin Message --}}
                    @if($quotation->admin_message)

                        <div class="mt-3">

                            <label class="text-muted mb-2">
                                Message from Admin
                            </label>

                            <div class="bg-light rounded p-3">

                                {{ $quotation->admin_message }}

                            </div>

                        </div>

                    @elseif($quotation->status === 'pending')

                        <p class="text-muted mb-0">

                            <i class="bi bi-info-circle me-1"></i>

                            The admin has not added a response yet.

                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

