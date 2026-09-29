
@extends('layouts.customer')

@section('title', 'Request Quotation')

@section('page-title', 'Request Quotation')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">

        <a href="{{ route('customer.products.show', $product) }}"
           class="text-decoration-none text-muted">

            <i class="bi bi-arrow-left me-1"></i>
            Back to Product

        </a>

        <h2 class="fw-bold mt-3 mb-1">
            Request a Quotation
        </h2>

        <p class="text-muted mb-0">
            Submit your requirements and we will review your quotation request.
        </p>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="row g-4">

        {{-- Product Information --}}
        <div class="col-lg-5">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h5 class="fw-bold mb-3">
                        Product Information
                    </h5>


                    {{-- Product Image --}}
                    @if($product->images && $product->images->count() > 0)

                        <img
                            src="{{ asset('storage/' . $product->images->first()->image) }}"
                            alt="{{ $product->name }}"
                            class="img-fluid rounded mb-3"
                            style="width:100%; height:260px; object-fit:cover;"
                        >

                    @else

                        <div
                            class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                            style="height:260px;"
                        >

                            <span style="font-size:60px;">
                                📦
                            </span>

                        </div>

                    @endif


                    {{-- Product Name --}}
                    <h4 class="fw-bold">
                        {{ $product->name }}
                    </h4>


                    {{-- Category --}}
                    @if($product->category)

                        <p class="text-muted mb-2">

                            <i class="bi bi-tag me-1"></i>

                            {{ $product->category->name }}

                        </p>

                    @endif


                    {{-- Price --}}
                    @if($product->price !== null)

                        <div class="mb-3">

                            <span class="text-muted">
                                Current Price:
                            </span>

                            <strong class="fs-5">
                                ${{ number_format($product->price, 2) }}
                            </strong>

                        </div>

                    @endif


                    {{-- Description --}}
                    @if($product->description)

                        <p class="text-muted mb-0">
                            {{ $product->description }}
                        </p>

                    @endif

                </div>

            </div>

        </div>


        {{-- Quotation Form --}}
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">
                        Quotation Details
                    </h5>


                    <form
                        action="{{ route('customer.quotations.store', $product) }}"
                        method="POST"
                    >

                        @csrf


                        {{-- Quantity --}}
                        <div class="mb-4">

                            <label
                                for="quantity"
                                class="form-label fw-semibold"
                            >

                                Required Quantity

                                <span class="text-danger">
                                    *
                                </span>

                            </label>

                            <input
                                type="number"
                                name="quantity"
                                id="quantity"
                                class="form-control @error('quantity') is-invalid @enderror"
                                value="{{ old('quantity', 1) }}"
                                min="1"
                                max="100000"
                                required
                            >

                            @error('quantity')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                            <small class="text-muted">
                                Enter the number of units you require.
                            </small>

                        </div>


                        {{-- Additional Requirements --}}
                        <div class="mb-4">

                            <label
                                for="message"
                                class="form-label fw-semibold"
                            >

                                Additional Requirements

                            </label>

                            <textarea
                                name="message"
                                id="message"
                                rows="6"
                                class="form-control @error('message') is-invalid @enderror"
                                placeholder="Tell us about your requirements, specifications, delivery needs, etc."
                            >{{ old('message') }}</textarea>

                            @error('message')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                            <small class="text-muted">
                                Maximum 2000 characters.
                            </small>

                        </div>


                        {{-- Information --}}
                        <div class="alert alert-info">

                            <div class="d-flex">

                                <i class="bi bi-info-circle fs-5 me-2"></i>

                                <div>

                                    <strong>
                                        How it works
                                    </strong>

                                    <p class="mb-0 mt-1">
                                        Submit your request and our admin will
                                        review it. You can check the quotation
                                        status from your Quotations section.
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between align-items-center">

                            <a
                                href="{{ route('customer.products.show', $product) }}"
                                class="btn btn-outline-secondary"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="btn btn-dark px-4"
                            >

                                <i class="bi bi-send me-1"></i>

                                Submit Quotation Request

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
