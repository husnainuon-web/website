@extends('layouts.customer')

@section('title', 'Products')
@section('page-title', 'Products')

@section('content')
<div class="container-fluid py-4">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
    <form action="{{ route('customer.products.index') }}" method="GET" class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md">
                    <label for="product-search" class="form-label">Search products or categories</label>
                    <input id="product-search" type="search" name="search" class="form-control"
                           value="{{ $search }}" placeholder="Product name, SKU, or category">
                </div>
                <div class="col-md-4">
                    <label for="product-category" class="form-label">Category</label>
                    <select id="product-category" name="category" class="form-select">
                        <option value="">All categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (string) $categoryId === (string) $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-auto d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-success">Search</button>
                    @if($search !== '' || $categoryId)
                        <a href="{{ route('customer.products.index') }}" class="btn btn-outline-secondary">Clear</a>
                    @endif
                </div>
            </div>
        </div>
    </form>
    @if($search !== '' || $categoryId)
        <p class="text-muted">Showing {{ $products->total() }} matching product(s).</p>
    @endif
    <div class="row g-3">
        @forelse($products as $product)
            <div class="col-6 col-lg-3">
                <article class="card h-100 border-0 shadow-sm">
                    @if($product->main_image)
                        <img src="{{ Storage::disk('public')->url($product->main_image) }}" class="card-img-top p-3" alt="{{ $product->name }}" style="height:190px;object-fit:contain">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height:190px">Image coming soon</div>
                    @endif
                    <div class="card-body">
                        <p class="small text-success fw-semibold mb-1">{{ $product->category_name }}</p>
                        <h2 class="h6 fw-bold">{{ $product->name }}</h2>
                        <p class="text-muted small">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>
                        <p class="fw-bold">${{ number_format((float) $product->price, 2) }}</p>
                        <a href="{{ route('customer.products.show', $product->id) }}" class="btn btn-success w-100">View product</a>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12"><div class="alert alert-light">{{ $search !== '' || $categoryId ? 'No products match your search. Try another keyword or category.' : 'No products are available right now.' }}</div></div>
        @endforelse
    </div>
    <div class="mt-4">{{ $products->withQueryString()->links() }}</div>
</div>
@endsection
