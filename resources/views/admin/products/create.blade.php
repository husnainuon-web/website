
@extends('layouts.app')

@section('content')

<div class="container py-4">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Add New Product
            </h2>

            <p class="text-muted mb-0">
                Add product information, images, price and stock.
            </p>
        </div>

        <a href="{{ route('admin.products.index') }}"
           class="btn btn-outline-secondary">
            ← Back to Products
        </a>

    </div>


    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- PRODUCT FORM --}}
    <form action="{{ route('admin.products.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf


        <div class="row g-4">


            {{-- ========================================= --}}
            {{-- LEFT SIDE --}}
            {{-- ========================================= --}}

            <div class="col-lg-8">


                {{-- BASIC INFORMATION --}}
                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">
                            Basic Information
                        </h5>

                    </div>


                    <div class="card-body">


                        {{-- CATEGORY --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Category *
                            </label>

                            <select
                                name="category_id"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Select Category
                                </option>

                                @foreach ($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- PRODUCT NAME --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Product Name *
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                placeholder="Enter product name"
                                required
                            >

                        </div>


                        {{-- SKU --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                SKU *
                            </label>

                            <input
                                type="text"
                                name="sku"
                                class="form-control"
                                value="{{ old('sku') }}"
                                placeholder="e.g. ZM-001"
                                required
                            >

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Description
                            </label>

                            <textarea
                                name="description"
                                rows="5"
                                class="form-control"
                                placeholder="Enter product description"
                            >{{ old('description') }}</textarea>

                        </div>

                    </div>

                </div>


                {{-- PRICE & STOCK --}}
                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">
                            Price & Stock
                        </h5>

                    </div>


                    <div class="card-body">

                        <div class="row">


                            {{-- PRICE --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Price *
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        USD
                                    </span>

                                    <input
                                        type="number"
                                        name="price"
                                        class="form-control"
                                        value="{{ old('price') }}"
                                        min="0"
                                        step="0.01"
                                        placeholder="0.00"
                                        required
                                    >

                                </div>

                            </div>


                            {{-- STOCK --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Stock *
                                </label>

                                <input
                                    type="number"
                                    name="stock"
                                    class="form-control"
                                    value="{{ old('stock', 0) }}"
                                    min="0"
                                    placeholder="Available quantity"
                                    required
                                >

                            </div>

                        </div>

                    </div>

                </div>


                {{-- PRODUCT IMAGES --}}
                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">
                            Product Images
                        </h5>

                    </div>


                    <div class="card-body">


                        {{-- MAIN IMAGE --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Main Product Image
                            </label>

                            <input
                                type="file"
                                name="main_image"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <small class="text-muted">
                                JPG, JPEG, PNG or WEBP.
                                Maximum 5MB.
                            </small>

                        </div>


                        {{-- GALLERY IMAGES --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Gallery Images
                            </label>

                            <input
                                type="file"
                                name="gallery_images[]"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                                multiple
                            >

                            <small class="text-muted">
                                You can select multiple images.
                                Maximum 10 images, 5MB each.
                            </small>

                        </div>

                    </div>

                </div>


                {{-- SPECIFICATIONS --}}
                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">
                            Specifications
                        </h5>

                    </div>


                    <div class="card-body">

                        <label class="form-label fw-semibold">
                            Product Specifications
                        </label>

                        <textarea
                            name="specifications"
                            rows="6"
                            class="form-control"
                            placeholder="Material: Stainless Steel&#10;Weight: 5 KG&#10;Color: Silver&#10;Size: Medium"
                        >{{ old('specifications') }}</textarea>

                        <small class="text-muted">

                            Write one specification per line using:

                            <strong>
                                Name: Value
                            </strong>

                        </small>

                    </div>

                </div>


                {{-- TAGS --}}
                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">
                            Tags
                        </h5>

                    </div>


                    <div class="card-body">

                        <label class="form-label fw-semibold">
                            Product Tags
                        </label>

                        <input
                            type="text"
                            name="tags"
                            class="form-control"
                            value="{{ old('tags') }}"
                            placeholder="machine, steel, manufacturing"
                        >

                        <small class="text-muted">
                            Separate tags with commas.
                        </small>

                    </div>

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- RIGHT SIDE --}}
            {{-- ========================================= --}}

            <div class="col-lg-4">


                {{-- PRODUCT STATUS --}}
                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">
                            Product Status
                        </h5>

                    </div>


                    <div class="card-body">


                        {{-- STATUS --}}
                        <div class="form-check form-switch mb-3">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="status"
                                value="1"
                                id="status"
                                {{ old('status', true) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label fw-semibold"
                                for="status"
                            >
                                Active Product
                            </label>

                        </div>


                        {{-- FEATURED --}}
                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_featured"
                                value="1"
                                id="is_featured"
                                {{ old('is_featured', false) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label fw-semibold"
                                for="is_featured"
                            >
                                Featured Product
                            </label>

                        </div>

                    </div>

                </div>


                {{-- IMAGE INFORMATION --}}
                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">
                            Image Guidelines
                        </h5>

                    </div>


                    <div class="card-body">

                        <ul class="mb-0 ps-3">

                            <li class="mb-2">
                                Main image is the primary product image.
                            </li>

                            <li class="mb-2">
                                Gallery images show additional product views.
                            </li>

                            <li class="mb-2">
                                Maximum 10 gallery images.
                            </li>

                            <li class="mb-2">
                                Maximum 5MB per image.
                            </li>

                            <li>
                                Supported: JPG, JPEG, PNG, WEBP.
                            </li>

                        </ul>

                    </div>

                </div>


                {{-- SAVE BUTTON --}}
                <div class="card shadow-sm border-0">

                    <div class="card-body">

                        <button
                            type="submit"
                            class="btn btn-primary w-100 py-2"
                        >
                            + Add Product
                        </button>


                        <a
                            href="{{ route('admin.products.index') }}"
                            class="btn btn-outline-secondary w-100 mt-2"
                        >
                            Cancel
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection

