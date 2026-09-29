
@extends('layouts.customer')

@section('title', 'Products')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1 fw-bold">Our Products</h2>

            <p class="text-muted mb-0">
                Explore products from Zain Manufacturing.
            </p>
        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- SEARCH & CATEGORY FILTER --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body p-4">

            <form
                method="GET"
                action="{{ route('customer.products.index') }}"
            >

                <div class="row g-3 align-items-end">

                    {{-- Search --}}
                    <div class="col-lg-6">

                        <label class="form-label fw-semibold">
                            Search Products
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>

                            <input
                                type="text"
                                name="search"
                                value="{{ $search ?? '' }}"
                                class="form-control"
                                placeholder="Search product by name..."
                            >

                        </div>

                    </div>


                    {{-- Category --}}
                    <div class="col-lg-4">

                        <label class="form-label fw-semibold">
                            Category
                        </label>

                        <select
                            name="category"
                            class="form-select"
                        >

                            <option value="">
                                All Categories
                            </option>

                            @foreach($categories as $item)

                                <option
                                    value="{{ $item->id }}"
                                    {{ (string)($category ?? '') === (string)$item->id ? 'selected' : '' }}
                                >
                                    {{ $item->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Buttons --}}
                    <div class="col-lg-2">

                        <button
                            type="submit"
                            class="btn btn-primary w-100 mb-2"
                        >
                            <i class="bi bi-search me-1"></i>
                            Search
                        </button>

                        <a
                            href="{{ route('customer.products.index') }}"
                            class="btn btn-outline-secondary w-100"
                        >
                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- Search Result Information --}}
    @if(!empty($search) || !empty($category))

        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h5 class="fw-bold mb-1">
                    Search Results
                </h5>

                <p class="text-muted small mb-0">

                    {{ $products->total() }}

                    {{ $products->total() == 1 ? 'product' : 'products' }}

                    found.

                    @if(!empty($search))
                        Search:
                        <strong>"{{ $search }}"</strong>
                    @endif

                </p>

            </div>

        </div>

    @endif


    {{-- Products --}}
    <div class="row">

        @forelse($products as $product)

            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">

                <div class="card product-card h-100 shadow-sm border-0">

                    {{-- Product Image --}}
                    <div class="text-center p-3">

                        @if($product->main_image)

                            <img
                                src="{{ asset('storage/' . $product->main_image) }}"
                                alt="{{ $product->name }}"
                                class="img-fluid rounded product-image"
                            >

                        @else

                            <div
                                class="d-flex align-items-center justify-content-center bg-light rounded product-image"
                            >

                                <span class="text-muted">
                                    No Image
                                </span>

                            </div>

                        @endif

                    </div>


                    {{-- Product Information --}}
                    <div class="card-body d-flex flex-column">

                        {{-- Category --}}
                        @if($product->category)

                            <small class="text-muted mb-1">
                                {{ $product->category->name }}
                            </small>

                        @endif


                        {{-- Product Name --}}
                        <h5 class="card-title fw-bold">
                            {{ $product->name }}
                        </h5>


                        {{-- Description --}}
                        <p class="card-text text-muted">

                            {{ \Illuminate\Support\Str::limit(
                                $product->description,
                                100
                            ) }}

                        </p>


                        {{-- Price --}}
                        <h5 class="text-primary mt-auto mb-2">

                            ${{ number_format((float) $product->price, 2) }}

                        </h5>


                        {{-- Stock --}}
                        @if($product->stock > 0)

                            <span class="badge bg-success mb-3">
                                <i class="bi bi-check-circle me-1"></i>
                                In Stock
                            </span>

                        @else

                            <span class="badge bg-danger mb-3">
                                <i class="bi bi-x-circle me-1"></i>
                                Out of Stock
                            </span>

                        @endif


                        {{-- View Button --}}
                        <a
                            href="{{ route('customer.products.show', $product) }}"
                            class="btn btn-primary w-100"
                        >
                            <i class="bi bi-eye me-1"></i>
                            View Product
                        </a>

                    </div>

                </div>

            </div>

        @empty

            {{-- No Products --}}
            <div class="col-12">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center py-5">

                        <div class="mb-3">

                            <i
                                class="bi bi-search fs-1 text-muted">
                            </i>

                        </div>

                        <h5 class="fw-bold">
                            No Products Found
                        </h5>

                        <p class="text-muted mb-3">

                            @if(!empty($search))

                                No products matched
                                "<strong>{{ $search }}</strong>".

                            @elseif(!empty($category))

                                No products are available
                                in this category.

                            @else

                                There are currently no products available.

                            @endif

                        </p>

                        <a
                            href="{{ route('customer.products.index') }}"
                            class="btn btn-outline-primary"
                        >
                            View All Products
                        </a>

                    </div>

                </div>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if($products->hasPages())

        <div class="d-flex justify-content-center mt-4">

            {{ $products->links() }}

        </div>

    @endif

</div>


{{-- Page Styling --}}
<style>

    .product-card {
        border-radius: 16px;
        overflow: hidden;
        transition: 0.25s ease;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.10) !important;
    }

    .product-image {
        height: 220px;
        width: 100%;
        object-fit: contain;
    }

    .form-control,
    .form-select,
    .input-group-text {
        border-radius: 10px;
    }

    .input-group .input-group-text {
        border-right: 0;
    }

    .input-group .form-control {
        border-left: 0;
    }

    .input-group .form-control:focus {
        border-left: 0;
        box-shadow: none;
    }

    .btn {
        border-radius: 9px;
    }

    .badge {
        width: fit-content;
        padding: 7px 10px;
        border-radius: 8px;
    }

</style>

@endsection

