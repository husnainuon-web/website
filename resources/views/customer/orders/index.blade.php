@extends('layouts.customer')

@section('title', 'Orders')
@section('page-title', 'Orders')

@section('content')
<div class="container-fluid py-4">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($orders->isEmpty())
        <div class="card border-0 shadow-sm"><div class="card-body text-center p-5">
            <h2 class="h4">No orders yet</h2>
            <p class="text-muted">Orders placed in this browser session will appear here.</p>
            <a href="{{ route('customer.products.index') }}" class="btn btn-success">Browse products</a>
        </div></div>
    @else
        <div class="table-responsive card border-0 shadow-sm"><table class="table align-middle mb-0">
            <thead><tr><th>Order</th><th>Date</th><th>Items</th><th>Total</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td class="fw-bold">{{ $order->order_number }}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>{{ $order->items_count }}</td>
                    <td>${{ number_format((float) $order->total_amount, 2) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td><a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-sm btn-outline-success">Details</a></td>
                </tr>
            @endforeach
            </tbody>
        </table></div>
        <div class="mt-3">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
