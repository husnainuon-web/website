@extends('layouts.customer')

@section('title', $product->name)
@section('page-title', $product->name)

@section('content')
<div class="container py-4">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <a href="{{ route('customer.products.index') }}" class="btn btn-outline-secondary mb-3">Back to products</a>
    <div class="card border-0 shadow-sm">
        <div class="row g-0">
            <div class="col-md-6 p-4 d-flex flex-column align-items-center justify-content-center bg-white">
                @if($product->main_image)
                    <img src="{{ Storage::disk('public')->url($product->main_image) }}" alt="{{ $product->name }}" class="img-fluid w-100" style="max-height:420px;object-fit:contain">
                @endif
                @if($product->main_video)
                    <video controls class="img-fluid w-100 mt-3" style="max-height:420px; background:#000; object-fit:contain">
                        <source src="{{ Storage::disk('public')->url($product->main_video) }}">
                    </video>
                @endif
                @if(!$product->main_image && !$product->main_video)
                    <div class="text-muted py-5">Image coming soon</div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="card-body p-4 p-lg-5">
                    @if($product->category_name)<p class="text-success fw-semibold">{{ $product->category_name }}</p>@endif
                    <h1 class="h2 fw-bold">{{ $product->name }}</h1>
                    <p class="text-muted">SKU: {{ $product->sku }}</p>
                    <p class="fs-3 fw-bold text-success">${{ number_format((float) $product->price, 2) }}</p>
                    <p>{{ $product->description }}</p>
                    <p class="small {{ $product->stock > 0 ? 'text-muted' : 'text-warning fw-semibold' }}">
                        {{ $product->stock > 0 ? 'In stock' : 'Currently out of stock — you can still submit an order request.' }}
                    </p>

                    @if($product->stock > 0)
                        <form action="{{ route('customer.cart.store', $product->id) }}" method="POST" class="d-flex gap-2 mb-3">
                            @csrf
                            <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="{{ $product->stock }}" class="form-control" style="max-width:100px" aria-label="Quantity">
                            <button class="btn btn-success flex-grow-1" type="submit">Add to cart</button>
                            <button class="btn btn-primary flex-grow-1" type="submit"
                                    formaction="{{ route('customer.products.order', $product->id) }}">
                                Submit Order
                            </button>
                        </form>
                        <p class="small text-muted">Submit Order will take you to checkout to enter delivery details and confirm.</p>
                    @else
                        <form action="{{ route('customer.products.order', $product->id) }}" method="POST" class="d-flex gap-2 mb-3">
                            @csrf
                            <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1"
                                   class="form-control" style="max-width:100px" aria-label="Quantity">
                            <button class="btn btn-primary flex-grow-1" type="submit">
                                Submit Order Request
                            </button>
                        </form>
                        <p class="small text-muted">We’ll confirm availability before processing this request.</p>
                    @endif

                    <div class="d-flex flex-wrap gap-2">
                        @if($isWishlisted)
                            <form action="{{ route('customer.wishlist.destroy', $product->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger" type="submit">Remove from wishlist</button>
                            </form>
                        @else
                            <form action="{{ route('customer.wishlist.store', $product->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-danger" type="submit">Save to wishlist</button>
                            </form>
                        @endif
                        <a href="{{ route('customer.quotations.create', $product->id) }}" class="btn btn-outline-dark">Request a quotation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
