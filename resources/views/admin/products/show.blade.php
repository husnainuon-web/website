@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Product Details
            </h2>

            <p class="text-muted mb-0">
                View complete product information.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('admin.products.index') }}"
               class="btn btn-outline-secondary rounded-3 px-3">
                <i class="bi bi-arrow-left me-1"></i>
                Back to Products
            </a>

            <a href="{{ route('admin.products.edit', $product) }}"
               class="btn btn-primary rounded-3 px-3">
                <i class="bi bi-pencil me-1"></i>
                Edit Product
            </a>

        </div>

    </div>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show rounded-3"
             role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================================================
         ERROR MESSAGE
    ========================================================== --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show rounded-3"
             role="alert">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif



    <div class="row g-4">


        {{-- =====================================================
             LEFT SIDE - IMAGES
        ====================================================== --}}
        <div class="col-lg-5">

            {{-- MAIN IMAGE --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-image me-2 text-primary"></i>
                        Product Image
                    </h5>

                </div>


                <div class="card-body p-4">

                    @if($product->main_image)

                        <div class="main-image-box">

                            <img src="{{ asset('storage/' . $product->main_image) }}"
                                 alt="{{ $product->name }}"
                                 class="main-product-image">

                        </div>

                    @else

                        <div class="no-image-box">

                            <i class="bi bi-image"></i>

                            <span>
                                No Image Available
                            </span>

                        </div>

                    @endif

                </div>

            </div>



            {{-- GALLERY --}}
            @if($product->images && $product->images->count())

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-header bg-white border-0 pt-4 px-4">

                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-images me-2 text-primary"></i>
                            Product Gallery
                        </h5>

                    </div>


                    <div class="card-body p-4">

                        <div class="row g-3">

                            @foreach($product->images as $image)

                                <div class="col-6 col-md-4">

                                    <div class="gallery-box">

                                        <img src="{{ asset('storage/' . $image->image) }}"
                                             alt="{{ $product->name }}"
                                             class="gallery-image">

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            @endif

        </div>



        {{-- =====================================================
             RIGHT SIDE - PRODUCT INFORMATION
        ====================================================== --}}
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4 p-lg-5">


                    {{-- CATEGORY --}}
                    @if($product->category)

                        <span class="category-badge mb-3">

                            <i class="bi bi-grid me-1"></i>

                            {{ $product->category->name }}

                        </span>

                    @endif


                    {{-- PRODUCT NAME --}}
                    <h1 class="product-title">

                        {{ $product->name }}

                    </h1>


                    {{-- SKU --}}
                    <div class="sku-box mb-4">

                        <span class="text-muted">
                            SKU
                        </span>

                        <strong>
                            {{ $product->sku }}
                        </strong>

                    </div>


                    {{-- PRICE --}}
                    <div class="price-box mb-4">

                        <span class="price-label">
                            Product Price
                        </span>

                        <div class="product-price">

                            ${{ number_format((float) $product->price, 2) }}

                        </div>

                    </div>



                    {{-- STOCK --}}
                    <div class="info-row">

                        <div class="info-label">
                            <i class="bi bi-box-seam me-2"></i>
                            Stock
                        </div>

                        <div>

                            @if($product->stock > 0)

                                <span class="badge bg-success rounded-pill px-3 py-2">

                                    In Stock

                                </span>

                                <span class="ms-2 text-muted">

                                    {{ $product->stock }} available

                                </span>

                            @else

                                <span class="badge bg-danger rounded-pill px-3 py-2">

                                    Out of Stock

                                </span>

                            @endif

                        </div>

                    </div>



                    {{-- STATUS --}}
                    <div class="info-row">

                        <div class="info-label">
                            <i class="bi bi-toggle-on me-2"></i>
                            Status
                        </div>

                        <div>

                            @if($product->status)

                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-danger rounded-pill px-3 py-2">
                                    Inactive
                                </span>

                            @endif

                        </div>

                    </div>



                    {{-- FEATURED --}}
                    <div class="info-row">

                        <div class="info-label">
                            <i class="bi bi-star me-2"></i>
                            Featured
                        </div>

                        <div>

                            @if($product->is_featured)

                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">

                                    <i class="bi bi-star-fill me-1"></i>
                                    Featured

                                </span>

                            @else

                                <span class="badge bg-secondary rounded-pill px-3 py-2">

                                    Not Featured

                                </span>

                            @endif

                        </div>

                    </div>



                    {{-- DESCRIPTION --}}
                    <div class="mt-4">

                        <h5 class="section-title">
                            Description
                        </h5>

                        <div class="description-box">

                            @if($product->description)

                                {!! nl2br(e($product->description)) !!}

                            @else

                                <span class="text-muted">
                                    No description available.
                                </span>

                            @endif

                        </div>

                    </div>



                    {{-- TAGS --}}
                    <div class="mt-4">

                        <h5 class="section-title">
                            Tags
                        </h5>


                        @if(is_array($product->tags) && count($product->tags))

                            <div class="d-flex flex-wrap gap-2">

                                @foreach($product->tags as $tag)

                                    <span class="tag-badge">

                                        <i class="bi bi-tag me-1"></i>

                                        {{ $tag }}

                                    </span>

                                @endforeach

                            </div>

                        @else

                            <p class="text-muted mb-0">
                                No tags available.
                            </p>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
         SPECIFICATIONS
    ========================================================== --}}
    <div class="card border-0 shadow-sm rounded-4 mt-4">

        <div class="card-header bg-white border-0 pt-4 px-4">

            <h5 class="fw-bold mb-0">

                <i class="bi bi-list-check me-2 text-primary"></i>

                Product Specifications

            </h5>

        </div>


        <div class="card-body p-4">

            @if(
                is_array($product->specifications)
                && count($product->specifications)
            )

                <div class="table-responsive">

                    <table class="table specification-table mb-0">

                        <tbody>

                            @foreach($product->specifications as $key => $value)

                                <tr>

                                    <th>
                                        {{ $key }}
                                    </th>

                                    <td>
                                        {{ $value }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-specifications">

                    <i class="bi bi-info-circle"></i>

                    <p class="mb-0">
                        No specifications available.
                    </p>

                </div>

            @endif

        </div>

    </div>



    {{-- =========================================================
         PRODUCT INFORMATION
    ========================================================== --}}
    <div class="card border-0 shadow-sm rounded-4 mt-4">

        <div class="card-header bg-white border-0 pt-4 px-4">

            <h5 class="fw-bold mb-0">

                <i class="bi bi-info-circle me-2 text-primary"></i>

                Product Information

            </h5>

        </div>


        <div class="card-body p-4">

            <div class="row g-4">


                {{-- PRODUCT NAME --}}
                <div class="col-md-4">

                    <div class="detail-item">

                        <span class="detail-label">
                            Product Name
                        </span>

                        <strong>
                            {{ $product->name }}
                        </strong>

                    </div>

                </div>



                {{-- CATEGORY --}}
                <div class="col-md-4">

                    <div class="detail-item">

                        <span class="detail-label">
                            Category
                        </span>

                        <strong>
                            {{ $product->category->name ?? 'N/A' }}
                        </strong>

                    </div>

                </div>



                {{-- SKU --}}
                <div class="col-md-4">

                    <div class="detail-item">

                        <span class="detail-label">
                            SKU
                        </span>

                        <strong>
                            {{ $product->sku }}
                        </strong>

                    </div>

                </div>



                {{-- PRICE --}}
                <div class="col-md-4">

                    <div class="detail-item">

                        <span class="detail-label">
                            Price
                        </span>

                        <strong>
                            ${{ number_format((float) $product->price, 2) }}
                        </strong>

                    </div>

                </div>



                {{-- STOCK --}}
                <div class="col-md-4">

                    <div class="detail-item">

                        <span class="detail-label">
                            Available Stock
                        </span>

                        <strong>
                            {{ $product->stock }}
                        </strong>

                    </div>

                </div>



                {{-- STATUS --}}
                <div class="col-md-4">

                    <div class="detail-item">

                        <span class="detail-label">
                            Status
                        </span>

                        <strong>

                            @if($product->status)

                                <span class="text-success">
                                    Active
                                </span>

                            @else

                                <span class="text-danger">
                                    Inactive
                                </span>

                            @endif

                        </strong>

                    </div>

                </div>



                {{-- CREATED --}}
                <div class="col-md-4">

                    <div class="detail-item">

                        <span class="detail-label">
                            Created
                        </span>

                        <strong>
                            {{ $product->created_at?->format('d M Y, h:i A') }}
                        </strong>

                    </div>

                </div>



                {{-- UPDATED --}}
                <div class="col-md-4">

                    <div class="detail-item">

                        <span class="detail-label">
                            Last Updated
                        </span>

                        <strong>
                            {{ $product->updated_at?->format('d M Y, h:i A') }}
                        </strong>

                    </div>

                </div>



                {{-- SLUG --}}
                <div class="col-md-4">

                    <div class="detail-item">

                        <span class="detail-label">
                            Slug
                        </span>

                        <strong>
                            {{ $product->slug }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
         ADMIN ACTIONS
    ========================================================== --}}
    <div class="card border-0 shadow-sm rounded-4 mt-4 mb-4">

        <div class="card-body p-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                <div>

                    <h5 class="fw-bold mb-1">
                        Product Actions
                    </h5>

                    <p class="text-muted mb-0">
                        Manage this product from the options below.
                    </p>

                </div>


                <div class="d-flex flex-wrap gap-2">

                    {{-- EDIT --}}
                    <a href="{{ route('admin.products.edit', $product) }}"
                       class="btn btn-primary rounded-3 px-4">

                        <i class="bi bi-pencil me-1"></i>

                        Edit Product

                    </a>


                    {{-- DELETE --}}
                    <form action="{{ route('admin.products.destroy', $product) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.');">

                        @csrf

                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-outline-danger rounded-3 px-4">

                            <i class="bi bi-trash me-1"></i>

                            Delete Product

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- =============================================================
     PAGE CSS
============================================================= --}}
<style>

body {
    background: #f6f8fa;
}


/* -------------------------------------------------------------
   Main Image
------------------------------------------------------------- */

.main-image-box {
    width: 100%;
    height: 430px;
    background: #f8f9fa;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.main-product-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 20px;
}


/* -------------------------------------------------------------
   No Image
------------------------------------------------------------- */

.no-image-box {
    width: 100%;
    height: 430px;
    background: #f8f9fa;
    border-radius: 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
}

.no-image-box i {
    font-size: 55px;
    margin-bottom: 12px;
}


/* -------------------------------------------------------------
   Gallery
------------------------------------------------------------- */

.gallery-box {
    height: 120px;
    background: #f8f9fa;
    border-radius: 12px;
    overflow: hidden;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.25s ease;
}

.gallery-image:hover {
    transform: scale(1.05);
}


/* -------------------------------------------------------------
   Category
------------------------------------------------------------- */

.category-badge {
    display: inline-block;
    background: #e9f7ef;
    color: #198754;
    padding: 7px 13px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 600;
}


/* -------------------------------------------------------------
   Product Title
------------------------------------------------------------- */

.product-title {
    font-size: 34px;
    font-weight: 800;
    color: #111827;
    margin-bottom: 12px;
}


/* -------------------------------------------------------------
   SKU
------------------------------------------------------------- */

.sku-box {
    display: flex;
    gap: 10px;
    align-items: center;
    font-size: 14px;
}


/* -------------------------------------------------------------
   Price
------------------------------------------------------------- */

.price-box {
    padding: 18px;
    background: #f8f9fa;
    border-radius: 14px;
}

.price-label {
    display: block;
    color: #6b7280;
    font-size: 13px;
    margin-bottom: 5px;
}

.product-price {
    color: #198754;
    font-size: 28px;
    font-weight: 800;
}


/* -------------------------------------------------------------
   Information Rows
------------------------------------------------------------- */

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #edf0f2;
}

.info-label {
    color: #4b5563;
    font-weight: 600;
}


/* -------------------------------------------------------------
   Section Titles
------------------------------------------------------------- */

.section-title {
    font-weight: 700;
    color: #111827;
    margin-bottom: 12px;
}


/* -------------------------------------------------------------
   Description
------------------------------------------------------------- */

.description-box {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 18px;
    color: #4b5563;
    line-height: 1.7;
}


/* -------------------------------------------------------------
   Tags
------------------------------------------------------------- */

.tag-badge {
    display: inline-flex;
    align-items: center;
    background: #eef4ff;
    color: #0d6efd;
    padding: 7px 12px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 600;
}


/* -------------------------------------------------------------
   Specifications
------------------------------------------------------------- */

.specification-table {
    border: 1px solid #edf0f2;
    border-radius: 12px;
    overflow: hidden;
}

.specification-table th {
    width: 35%;
    background: #f8f9fa;
    font-weight: 600;
    color: #374151;
    padding: 15px;
}

.specification-table td {
    padding: 15px;
    color: #4b5563;
}


/* -------------------------------------------------------------
   Empty Specifications
------------------------------------------------------------- */

.empty-specifications {
    text-align: center;
    padding: 35px;
    color: #9ca3af;
}

.empty-specifications i {
    display: block;
    font-size: 30px;
    margin-bottom: 10px;
}


/* -------------------------------------------------------------
   Product Details
------------------------------------------------------------- */

.detail-item {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 18px;
    height: 100%;
}

.detail-label {
    display: block;
    color: #6b7280;
    font-size: 12px;
    margin-bottom: 7px;
}

.detail-item strong {
    color: #111827;
    font-size: 14px;
    word-break: break-word;
}


/* -------------------------------------------------------------
   Cards
------------------------------------------------------------- */

.card {
    border: 1px solid #edf0f2 !important;
}


/* -------------------------------------------------------------
   Mobile
------------------------------------------------------------- */

@media (max-width: 768px) {

    .product-title {
        font-size: 27px;
    }

    .main-image-box,
    .no-image-box {
        height: 320px;
    }

    .info-row {
        align-items: flex-start;
        gap: 15px;
    }

    .product-price {
        font-size: 24px;
    }

}

</style>

@endsection