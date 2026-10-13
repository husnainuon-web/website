@extends('layouts.customer')

@section('title', 'Wishlist')
@section('page-title', 'Wishlist')

@section('content')
<div class="container-fluid py-4">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="row g-3">
        @forelse($wishlistItems as $product)
            <div class="col-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    @if($product->main_image)<img src="{{ Storage::disk('public')->url($product->main_image) }}" class="card-img-top p-3" alt="{{ $product->name }}" style="height:180px;object-fit:contain">@endif
                    <div class="card-body">
                        <h2 class="h6 fw-bold">{{ $product->name }}</h2>
                        <p class="fw-bold">${{ number_format((float) $product->price, 2) }}</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('customer.products.show', $product->id) }}" class="btn btn-success btn-sm flex-grow-1">View</a>
                            <form action="{{ route('customer.wishlist.destroy', $product->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" type="submit" aria-label="Remove {{ $product->name }}">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><div class="card border-0 shadow-sm"><div class="card-body text-center p-5">
                <h2 class="h4">Your wishlist is empty</h2>
                <a href="{{ route('customer.products.index') }}" class="btn btn-success mt-2">Browse products</a>
            </div></div></div>
        @endforelse
    </div>
</div>
@endsection
