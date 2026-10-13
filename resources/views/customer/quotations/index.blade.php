@extends('layouts.customer')

@section('title', 'Quotations')
@section('page-title', 'Quotations')

@section('content')
<div class="container-fluid py-4">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($quotations->isEmpty())
        <div class="card border-0 shadow-sm"><div class="card-body text-center p-5">
            <h2 class="h4">No quotation requests yet</h2>
            <p class="text-muted">Requests made in this browser session will appear here.</p>
            <a href="{{ route('customer.products.index') }}" class="btn btn-success">Browse products</a>
        </div></div>
    @else
        <div class="table-responsive card border-0 shadow-sm"><table class="table align-middle mb-0">
            <thead><tr><th>Request</th><th>Product</th><th>Quantity</th><th>Status</th><th>Date</th><th></th></tr></thead>
            <tbody>
            @foreach($quotations as $quotation)
                <tr>
                    <td>#{{ $quotation->id }}</td>
                    <td>{{ $quotation->product->name ?? 'Product unavailable' }}</td>
                    <td>{{ $quotation->quantity }}</td>
                    <td>{{ ucfirst($quotation->status) }}</td>
                    <td>{{ $quotation->created_at->format('d M Y') }}</td>
                    <td><a href="{{ route('customer.quotations.show', $quotation->id) }}" class="btn btn-sm btn-outline-success">Details</a></td>
                </tr>
            @endforeach
            </tbody>
        </table></div>
        <div class="mt-3">{{ $quotations->links() }}</div>
    @endif
</div>
@endsection
