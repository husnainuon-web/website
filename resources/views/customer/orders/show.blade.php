@extends('layouts.customer')

@section('title', 'Order details')
@section('page-title', 'Order details')

@section('content')
<div class="container py-4">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="card border-0 shadow-sm"><div class="card-body p-4">
        <div class="d-flex justify-content-between flex-wrap gap-2">
            <h2 class="h4 fw-bold">Order {{ $order->order_number }}</h2>
            <span class="badge text-bg-success align-self-start">{{ ucfirst($order->status) }}</span>
        </div>
        <p class="text-muted">{{ $order->created_at->format('d M Y, h:i A') }}</p>
        <hr>
        @foreach($items as $item)
            <div class="d-flex justify-content-between py-2 border-bottom">
                <span>{{ $item->product_name }} × {{ $item->quantity }}</span>
                <span>${{ number_format((float) $item->subtotal, 2) }}</span>
            </div>
        @endforeach
        <div class="d-flex justify-content-between fw-bold fs-5 mt-3"><span>Total</span><span>${{ number_format((float) $order->total_amount, 2) }}</span></div>
        <p class="mt-4 mb-1"><strong>Delivery to:</strong> {{ $order->customer_name }}</p>
        <p class="mb-1">{{ $order->shipping_address }}{{ $order->city ? ', ' . $order->city : '' }}</p>
        <p class="text-muted mb-0">{{ $order->customer_email }}{{ $order->customer_phone ? ' · ' . $order->customer_phone : '' }}</p>
        <a href="{{ route('customer.orders.index') }}" class="btn btn-outline-secondary mt-4">Back to orders</a>
    </div></div>
</div>
@endsection
