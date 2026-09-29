@extends('layouts.admin')

@section('title', 'Products')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">Products</h2>

            <p class="text-muted mb-0">
                Manage all products from here.
            </p>
        </div>

        <a href="{{ route('admin.products.create') }}"
           class="btn btn-primary">

            + Add Product

        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Error Messages --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Products Card --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">

            <h5 class="mb-0 fw-bold">
                All Products
            </h5>

        </div>


        <div class="card-body">


            @if($products->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>

                                <th>Image</th>

                                <th>Product</th>

                                <th>SKU</th>

                                <th>Category</th>

                                <th>Price</th>

                                <th>Stock</th>

                                <th>Status</th>

                                <th>Featured</th>

                                <th>Actions</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($products as $product)

                                <tr>

                                    {{-- Number --}}
                                    <td>

                                        {{ $products->firstItem() + $loop->index }}

                                    </td>


                                    {{-- Product Image --}}
                                    <td>

                                        @if($product->main_image)

                                            <img
                                                src="{{ asset('storage/' . $product->main_image) }}"
                                                alt="{{ $product->name }}"
                                                width="60"
                                                height="60"
                                                style="object-fit: cover;"
                                                class="rounded"
                                            >

                                        @else

                                            <div
                                                class="bg-light border rounded d-flex align-items-center justify-content-center"
                                                style="width:60px;height:60px;"
                                            >

                                                <small class="text-muted">
                                                    No Image
                                                </small>

                                            </div>

                                        @endif

                                    </td>


                                    {{-- Product Name --}}
                                    <td>

                                        <strong>
                                            {{ $product->name }}
                                        </strong>

                                    </td>


                                    {{-- SKU --}}
                                    <td>

                                        {{ $product->sku }}

                                    </td>


                                    {{-- Category --}}
                                    <td>

                                        {{ $product->category->name ?? 'N/A' }}

                                    </td>


                                    {{-- Price --}}
                                    <td>

                                        <strong>
                                            ${{ number_format($product->price, 2) }}
                                        </strong>

                                    </td>


                                    {{-- Stock --}}
                                    <td>

                                        @if($product->stock > 0)

                                            <span class="badge bg-success">

                                                {{ $product->stock }}

                                            </span>

                                        @else

                                            <span class="badge bg-danger">

                                                Out of Stock

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($product->status)

                                            <span class="badge bg-success">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Featured --}}
                                    <td>

                                        @if($product->is_featured)

                                            <span class="badge bg-warning text-dark">
                                                Featured
                                            </span>

                                        @else

                                            <span class="badge bg-light text-dark">
                                                No
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Actions --}}
                                    <td>

                                        <div class="d-flex gap-1">


                                            {{-- View --}}
                                            <a
                                                href="{{ route('admin.products.show', $product) }}"
                                                class="btn btn-sm btn-info text-white"
                                            >
                                                View
                                            </a>


                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('admin.products.edit', $product) }}"
                                                class="btn btn-sm btn-warning"
                                            >
                                                Edit
                                            </a>


                                            {{-- Delete --}}
                                            <form
                                                action="{{ route('admin.products.destroy', $product) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this product?');"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-danger"
                                                >
                                                    Delete
                                                </button>

                                            </form>


                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="mt-4">

                    {{ $products->links() }}

                </div>


            @else


                {{-- No Products --}}
                <div class="text-center py-5">

                    <h4 class="fw-bold">
                        No Products Found
                    </h4>

                    <p class="text-muted">
                        You haven't added any products yet.
                    </p>


                    <a
                        href="{{ route('admin.products.create') }}"
                        class="btn btn-primary"
                    >
                        + Add Your First Product
                    </a>

                </div>


            @endif


        </div>

    </div>

</div>

@endsection