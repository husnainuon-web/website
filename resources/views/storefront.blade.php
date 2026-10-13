@extends('layouts.customer')

@section('title', 'Home')
@section('page-title', 'Home')

@section('content')
<div class="container-fluid py-4">
    <div class="p-4 p-md-5 mb-4 rounded-3 text-white" style="background:#176b47;">
        <p class="text-uppercase fw-bold mb-2">Built to keep industry moving</p>
        <h1 class="display-6 fw-bold">Reliable equipment. Unstoppable progress.</h1>
        <p class="mb-0">Find dependable tools and equipment, then order online with ease—no account required.</p>
        <form action="{{ route('customer.products.index') }}" method="GET" class="row g-2 mt-4">
            <div class="col-md">
                <label for="store-search" class="visually-hidden">Search products or categories</label>
                <input id="store-search" type="search" name="search" class="form-control form-control-lg"
                       value="{{ $search }}" placeholder="Search products or categories">
            </div>
            <div class="col-md-4">
                <label for="store-category" class="visually-hidden">Choose a category</label>
                <select id="store-category" name="category" class="form-select form-select-lg">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (string) $categoryId === (string) $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-auto">
                <button type="submit" class="btn btn-light btn-lg w-100">Search</button>
            </div>
        </form>
    </div>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="h4 fw-bold mb-0">{{ $search !== '' || $categoryId ? 'Search results' : 'Featured products' }}</h2>
        <a href="{{ route('customer.products.index') }}" class="btn btn-outline-success">Browse all</a>
    </div>

    <div class="row g-3">
        @forelse($products as $product)
            <div class="col-6 col-lg-3">
                <article class="card h-100 border-0 shadow-sm">
                    @if($product->main_image)
                        <img src="{{ Storage::disk('public')->url($product->main_image) }}" class="card-img-top p-3" alt="{{ $product->name }}" style="height:190px;object-fit:contain">
                    @else
                        <div class="bg-light d-grid place-items-center text-muted" style="height:190px">Image coming soon</div>
                    @endif
                    <div class="card-body">
                        <p class="small text-success fw-semibold mb-1">{{ $product->category_name }}</p>
                        <h3 class="h6 fw-bold">{{ $product->name }}</h3>
                        <p class="fw-bold mb-3">${{ number_format((float) $product->price, 2) }}</p>
                        <a href="{{ route('customer.products.show', $product->id) }}" class="btn btn-success w-100">View product</a>
                    </div>
                </article>
            </div>
        @empty
            <p class="text-muted">{{ $search !== '' || $categoryId ? 'No products match your search. Try another keyword or category.' : 'No products are available right now.' }}</p>
        @endforelse
    </div>
</div>
@endsection
