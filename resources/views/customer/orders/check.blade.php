@extends('layouts.customer')

@section('title', 'Checkout')
@section('page-title', 'Checkout')

@section('content')
<div class="container-fluid py-4">
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm"><div class="card-body p-4">
                <h2 class="h4 fw-bold mb-3">Delivery information</h2>
                <p class="text-muted">You can place an order as a guest. Creating an account is optional.</p>
                @if($cartItems->contains(fn ($item) => $item->availabilityRequested))
                    <div class="alert alert-warning">
                        Your order includes an out-of-stock item request. We’ll confirm availability before processing it.
                    </div>
                @endif
                <form action="{{ route('customer.checkout.store') }}" method="POST">
                    @csrf
                    <div class="mb-3"><label for="customer_name" class="form-label">Full name</label>
                        <input id="customer_name" name="customer_name" class="form-control" required maxlength="255" value="{{ old('customer_name', auth()->user()?->name) }}"></div>
                    <div class="mb-3"><label for="customer_email" class="form-label">Email</label>
                        <input id="customer_email" name="customer_email" type="email" class="form-control" required maxlength="255" value="{{ old('customer_email', auth()->user()?->email) }}"></div>
                    <div class="mb-3"><label for="customer_phone" class="form-label">Phone</label>
                        <input id="customer_phone" name="customer_phone" class="form-control" maxlength="50" value="{{ old('customer_phone') }}"></div>
                    <div class="mb-3"><label for="shipping_address" class="form-label">Shipping address</label>
                        <textarea id="shipping_address" name="shipping_address" rows="3" class="form-control" required>{{ old('shipping_address') }}</textarea></div>
                    <div class="mb-3"><label for="city" class="form-label">City</label>
                        <input id="city" name="city" class="form-control" maxlength="255" value="{{ old('city') }}"></div>
                    <div class="mb-3"><label for="notes" class="form-label">Order notes (optional)</label>
                        <textarea id="notes" name="notes" rows="2" class="form-control">{{ old('notes') }}</textarea></div>
                    <button type="submit" class="btn btn-success w-100">Place order</button>
                </form>
            </div></div>
        </div>
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm"><div class="card-body p-4">
                <h2 class="h4 fw-bold mb-3">Order summary</h2>
                @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between gap-3 mb-2">
                        <span>
                            {{ $item->product->name }} × {{ $item->quantity }}
                            @if($item->availabilityRequested)
                                <span class="badge text-bg-warning">Availability confirmation required</span>
                            @endif
                        </span>
                        <span>${{ number_format((float) $item->product->price * $item->quantity, 2) }}</span>
                    </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between fw-bold"><span>Total</span><span>${{ number_format($total, 2) }}</span></div>
            </div></div>
        </div>
    </div>
</div>
@endsection
