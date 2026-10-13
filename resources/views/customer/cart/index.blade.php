@extends('layouts.customer')

@section('title', 'Cart')
@section('page-title', 'Cart')

@section('content')
<div class="container-fluid py-4">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

    @forelse($cartItems as $item)
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body d-flex flex-wrap align-items-center gap-3">
                <div class="flex-grow-1">
                    <a class="fw-bold text-dark" href="{{ route('customer.products.show', $item->product->id) }}">{{ $item->product->name }}</a>
                    <div class="text-muted">${{ number_format((float) $item->product->price, 2) }} each</div>
                </div>
                <form action="{{ route('customer.cart.update', $item->product->id) }}" method="POST" class="d-flex gap-2">
                    @csrf @method('PATCH')
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="form-control" style="width:90px" aria-label="Quantity">
                    <button class="btn btn-outline-secondary" type="submit">Update</button>
                </form>
                <strong>${{ number_format((float) $item->product->price * $item->quantity, 2) }}</strong>
                <form action="{{ route('customer.cart.destroy', $item->product->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger" type="submit">Remove</button>
                </form>
            </div>
        </div>
    @empty
        <div class="card border-0 shadow-sm"><div class="card-body text-center p-5">
            <h2 class="h4">Your cart is empty</h2>
            <a href="{{ route('customer.products.index') }}" class="btn btn-success mt-2">Browse products</a>
        </div></div>
    @endforelse

    @if($cartItems->isNotEmpty())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <h2 class="h5 mb-0">Total: ${{ number_format($total, 2) }}</h2>
            <a href="{{ route('customer.checkout') }}" class="btn btn-success">Continue to checkout</a>
        </div>
    @endif
</div>
@endsection
