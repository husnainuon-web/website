
@extends('layouts.customer')

@section('title', 'Recommended Products')

@section('content')

<div class="container-fluid py-4">

    {{-- Page Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            Recommended For You
        </h2>

        <p class="text-muted mb-0">
            Products recommended based on your recent activity.
        </p>
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- Recently Viewed Products --}}
    @if($viewedProducts->isNotEmpty())

        <div class="mb-5">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="fw-bold mb-1">
                        Recently Viewed
                    </h4>

                    <p class="text-muted mb-0">
                        Products you have viewed recently.
                    </p>
                </div>
            </div>


            <div class="row g-4">

                @foreach($viewedProducts as $view)

                    @php
                        $product = $view->product;
                    @endphp

                    @if($product)

                        <div class="col-xl-3 col-lg-4 col-md-6">

                            <div class="card h-100 shadow-sm border-0">

                                {{-- Product Image --}}
                                @if($product->images->isNotEmpty())

                                    <img
                                        src="{{ asset('storage/' . $product->images->first()->image) }}"
                                        class="card-img-top"
                                        alt="{{ $product->name }}"
                                        style="height: 210px; object-fit: cover;"
                                    >

                                @else

                                    <div
                                        class="d-flex align-items-center justify-content-center bg-light"
                                        style="height: 210px;"
                                    >
                                        <span class="text-muted">
                                            No Image
                                        </span>
                                    </div>

                                @endif


                                <div class="card-body">

                                    {{-- Category --}}
                                    @if($product->category)
                                        <small class="text-muted">
                                            {{ $product->category->name }}
                                        </small>
                                    @endif

                                    <h5 class="fw-bold mt-2">
                                        {{ $product->name }}
                                    </h5>


                                    {{-- Price --}}
                                    <div class="mb-3">

                                        @if($product->price !== null)

                                            <span class="fw-bold text-primary">
                                                ${{ number_format($product->price, 2) }}
                                            </span>

                                        @else

                                            <span class="text-muted">
                                                Price on request
                                            </span>

                                        @endif

                                    </div>


                                    <a
                                        href="{{ route('customer.products.show', $product) }}"
                                        class="btn btn-outline-primary w-100"
                                    >
                                        View Product
                                    </a>

                                </div>

                            </div>

                        </div>

                    @endif

                @endforeach

            </div>

        </div>

    @endif


    {{-- Recommended Products --}}
    <div>

        <div class="mb-3">

            <h4 class="fw-bold mb-1">
                Recommended Products
            </h4>

            <p class="text-muted mb-0">
                You may also be interested in these products.
            </p>

        </div>


        @if($recommendations->isNotEmpty())

            <div class="row g-4">

                @foreach($recommendations as $product)

                    <div class="col-xl-3 col-lg-4 col-md-6">

                        <div class="card h-100 shadow-sm border-0">

                            {{-- Product Image --}}
                            @if($product->images->isNotEmpty())

                                <img
                                    src="{{ asset('storage/' . $product->images->first()->image) }}"
                                    class="card-img-top"
                                    alt="{{ $product->name }}"
                                    style="height: 230px; object-fit: cover;"
                                >

                            @else

                                <div
                                    class="d-flex align-items-center justify-content-center bg-light"
                                    style="height: 230px;"
                                >
                                    <span class="text-muted">
                                        No Image
                                    </span>
                                </div>

                            @endif


                            <div class="card-body d-flex flex-column">

                                {{-- Category --}}
                                @if($product->category)

                                    <small class="text-muted mb-1">
                                        {{ $product->category->name }}
                                    </small>

                                @endif


                                {{-- Product Name --}}
                                <h5 class="fw-bold mb-2">
                                    {{ $product->name }}
                                </h5>


                                {{-- Description --}}
                                @if($product->description)

                                    <p class="text-muted small mb-3">
                                        {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                                    </p>

                                @endif


                                {{-- Price --}}
                                <div class="mb-3">

                                    @if($product->price !== null)

                                        <span class="fs-5 fw-bold text-primary">
                                            ${{ number_format($product->price, 2) }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            Price on request
                                        </span>

                                    @endif

                                </div>


                                {{-- Button --}}
                                <div class="mt-auto">

                                    <a
                                        href="{{ route('customer.products.show', $product) }}"
                                        class="btn btn-primary w-100"
                                    >
                                        View Product
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- No Recommendations --}}
            <div class="card border-0 shadow-sm">

                <div class="card-body text-center py-5">

                    <div class="mb-3">
                        <span style="font-size: 50px;">
                            🤖
                        </span>
                    </div>

                    <h4 class="fw-bold">
                        No Recommendations Yet
                    </h4>

                    <p class="text-muted mb-4">
                        Browse some products first and we will recommend
                        similar products for you.
                    </p>

                    <a
                        href="{{ route('customer.products.index') }}"
                        class="btn btn-primary"
                    >
                        Browse Products
                    </a>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection

