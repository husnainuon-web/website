@extends('layouts.customer')

@section('title', 'Quotation request')
@section('page-title', 'Quotation request')

@section('content')
<div class="container py-4">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="card border-0 shadow-sm"><div class="card-body p-4">
        <h2 class="h4 fw-bold">Request #{{ $quotation->id }}</h2>
        <p><strong>Product:</strong> {{ $quotation->product->name ?? 'Product unavailable' }}</p>
        <p><strong>Quantity:</strong> {{ $quotation->quantity }}</p>
        <p><strong>Status:</strong> {{ ucfirst($quotation->status) }}</p>
        <p><strong>Requested:</strong> {{ $quotation->created_at->format('d M Y') }}</p>
        @if($quotation->message)<p><strong>Your requirements:</strong> {{ $quotation->message }}</p>@endif
        @if($quotation->quoted_price !== null)<p><strong>Quoted price:</strong> ${{ number_format((float) $quotation->quoted_price, 2) }}</p>@endif
        @if($quotation->admin_message)<div class="alert alert-light">{{ $quotation->admin_message }}</div>@endif
        <a href="{{ route('customer.quotations.index') }}" class="btn btn-outline-secondary">Back to quotations</a>
    </div></div>
</div>
@endsection
