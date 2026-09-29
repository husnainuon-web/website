@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Product</h2>

        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            ← Back to Products
        </a>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Edit Product Information</h5>
        </div>

        <div class="card-body">

            @php
                $specificationsText = '';

                if (is_array($product->specifications)) {
                    foreach ($product->specifications as $key => $value) {
                        $specificationsText .= $key . ': ' . $value . PHP_EOL;
                    }
                }
            @endphp

            <form
                action="{{ route('admin.products.update', $product) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')

                <div class="row">

                    {{-- Product Name --}}
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">
                            Product Name <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            value="{{ old('name', $product->name) }}"
                            required
                        >
                    </div>

                    {{-- SKU --}}
                    <div class="col-md-6 mb-3">
                        <label for="sku" class="form-label">
                            SKU <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="sku"
                            id="sku"
                            class="form-control"
                            value="{{ old('sku', $product->sku) }}"
                            required
                        >
                    </div>

                    {{-- Category --}}
                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">
                            Category <span class="text-danger">*</span>
                        </label>

                        <select
                            name="category_id"
                            id="category_id"
                            class="form-select"
                            required
                        >
                            <option value="">Select Category</option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Price --}}
                    <div class="col-md-3 mb-3">
                        <label for="price" class="form-label">
                            Price <span class="text-danger">*</span>
                        </label>

                        <input
                            type="number"
                            name="price"
                            id="price"
                            class="form-control"
                            value="{{ old('price', $product->price) }}"
                            min="0"
                            step="0.01"
                            required
                        >
                    </div>

                    {{-- Stock --}}
                    <div class="col-md-3 mb-3">
                        <label for="stock" class="form-label">
                            Stock <span class="text-danger">*</span>
                        </label>

                        <input
                            type="number"
                            name="stock"
                            id="stock"
                            class="form-control"
                            value="{{ old('stock', $product->stock) }}"
                            min="0"
                            required
                        >
                    </div>

                    {{-- Description --}}
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            class="form-control"
                            rows="5"
                            placeholder="Enter product description"
                        >{{ old('description', $product->description) }}</textarea>
                    </div>

                    {{-- Specifications --}}
                    <div class="col-md-6 mb-3">
                        <label for="specifications" class="form-label">
                            Specifications
                        </label>

                        <textarea
                            name="specifications"
                            id="specifications"
                            class="form-control"
                            rows="7"
                            placeholder="Material: Steel&#10;Color: Black&#10;Weight: 5kg"
                        >{{ old('specifications', $specificationsText) }}</textarea>

                        <small class="text-muted">
                            Write one specification per line using:
                            <strong>Key: Value</strong>
                        </small>
                    </div>

                    {{-- Tags --}}
                    <div class="col-md-6 mb-3">
                        <label for="tags" class="form-label">
                            Tags
                        </label>

                        <textarea
                            name="tags"
                            id="tags"
                            class="form-control"
                            rows="7"
                            placeholder="machine, industrial, steel, manufacturing"
                        >{{ old('tags', is_array($product->tags) ? implode(', ', $product->tags) : '') }}</textarea>

                        <small class="text-muted">
                            Separate tags with commas.
                        </small>
                    </div>

                    {{-- Current Main Image --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Current Main Image
                        </label>

                        @if($product->main_image)

                            <div class="mb-3">
                                <img
                                    src="{{ asset('storage/' . $product->main_image) }}"
                                    alt="{{ $product->name }}"
                                    class="img-thumbnail"
                                    style="width: 200px; height: 150px; object-fit: cover;"
                                >
                            </div>

                        @else

                            <div class="alert alert-secondary">
                                No image available.
                            </div>

                        @endif

                    </div>

                    {{-- New Main Image --}}
                    <div class="col-md-6 mb-3">

                        <label for="main_image" class="form-label">
                            Replace Main Image
                        </label>

                        <input
                            type="file"
                            name="main_image"
                            id="main_image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            Leave empty if you want to keep the current image.
                        </small>

                    </div>

                    {{-- Status --}}
                    <div class="col-md-6 mb-3">

                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="status"
                                value="1"
                                id="status"
                                {{ old('status', $product->status) ? 'checked' : '' }}
                            >

                            <label class="form-check-label" for="status">
                                Active Product
                            </label>

                        </div>

                    </div>

                    {{-- Featured --}}
                    <div class="col-md-6 mb-3">

                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_featured"
                                value="1"
                                id="is_featured"
                                {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                            >

                            <label class="form-check-label" for="is_featured">
                                Featured Product
                            </label>

                        </div>

                    </div>

                </div>

                <hr>

                {{-- Buttons --}}
                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        Update Product
                    </button>

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection