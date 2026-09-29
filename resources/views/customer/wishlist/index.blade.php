@extends('layouts.customer')

@section('title', 'My Wishlist')

@section('page-title', 'My Wishlist')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">My Wishlist ❤️</h2>
            <p class="text-muted mb-0">
                Products you have saved for later.
            </p>
        </div>

        <a href="{{ route('customer.products.index') }}"
           class="btn btn-outline-primary">
            Browse Products
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    @if($wishlists->count() > 0)

        <div class="row g-4">

            @foreach($wishlists as $wishlist)

                @php
                    $product = $wishlist->product;
                @endphp

                @if($product)

                    <div class="col-md-6 col-lg-4">

                        <div class="card h-100 shadow-sm border-0">

                            @if($product->main_image)

                                <img src="{{ asset('storage/' . $product->main_image) }}"
                                     class="card-img-top"
                                     alt="{{ $product->name }}"
                                     style="height:220px; object-fit:cover;">

                            @else

                                <div class="d-flex align-items-center justify-content-center bg-light"
                                     style="height:220px;">
                                    <span class="text-muted">
                                        No Image
                                    </span>
                                </div>

                            @endif


                            <div class="card-body">

                                <h5 class="fw-bold">
                                    {{ $product->name }}
                                </h5>

                                @if($product->category)

                                    <small class="text-muted">
                                        {{ $product->category->name }}
                                    </small>

                                @endif

                                <h5 class="text-primary mt-3">
                                    ${{ number_format($product->price, 2) }}
                                </h5>


                                <div class="d-flex gap-2 mt-3">

                                    <a href="{{ route('customer.products.show', $product) }}"
                                       class="btn btn-primary flex-grow-1">
                                        View Product
                                    </a>


                                    <form action="{{ route('customer.wishlist.destroy', $product) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-outline-danger"
                                                title="Remove from wishlist">
                                            ♥
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @endif

            @endforeach

        </div>


        <div class="mt-4">
            {{ $wishlists->links() }}
        </div>

    @else

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <div style="font-size:60px;">
                    ♡
                </div>

                <h4 class="fw-bold mt-3">
                    Your Wishlist is Empty
                </h4>

                <p class="text-muted">
                    Save products you like and find them here later.
                </p>

                <a href="{{ route('customer.products.index') }}"
                   class="btn btn-primary">
                    Browse Products
                </a>

            </div>

        </div>

    @endif

</div>

@endsection