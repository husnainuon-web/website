@extends('layouts.customer')

@section('title', 'Request a quotation')
@section('page-title', 'Request a quotation')

@section('content')
<div class="container py-4">
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <div class="card border-0 shadow-sm"><div class="card-body p-4">
        <h2 class="h4 fw-bold">{{ $product->name }}</h2>
        <p class="text-muted">Send a quotation request as a guest or sign in to save it to your account.</p>
        <form action="{{ route('customer.quotations.store', $product->id) }}" method="POST">
            @csrf
            <div class="mb-3"><label for="customer_name" class="form-label">Full name</label>
                <input id="customer_name" name="customer_name" class="form-control" required maxlength="255" value="{{ old('customer_name', auth()->user()?->name) }}"></div>
            <div class="mb-3"><label for="customer_email" class="form-label">Email</label>
                <input id="customer_email" name="customer_email" type="email" class="form-control" required maxlength="255" value="{{ old('customer_email', auth()->user()?->email) }}"></div>
            <div class="mb-3"><label for="customer_phone" class="form-label">Phone (optional)</label>
                <input id="customer_phone" name="customer_phone" class="form-control" maxlength="50" value="{{ old('customer_phone') }}"></div>
            <div class="mb-3"><label for="quantity" class="form-label">Quantity</label>
                <input id="quantity" name="quantity" type="number" min="1" class="form-control" required value="{{ old('quantity', 1) }}"></div>
            <div class="mb-3"><label for="message" class="form-label">Requirements (optional)</label>
                <textarea id="message" name="message" rows="4" class="form-control">{{ old('message') }}</textarea></div>
            <button type="submit" class="btn btn-success">Send request</button>
            <a href="{{ route('customer.products.show', $product->id) }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div></div>
</div>
@endsection
