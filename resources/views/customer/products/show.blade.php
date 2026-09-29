@extends('layouts.customer')

@section('title', $product->name)

@section('content')

<div class="container py-4">

```
{{-- Back Button --}}
<div class="mb-4">
    <a href="{{ route('customer.products.index') }}"
       class="btn btn-secondary">
        ← Back to Products
    </a>
</div>

<div class="row">

    {{-- Product Image --}}
    <div class="col-md-6 mb-4">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                @if($product->main_image)

                    <img
                        src="{{ asset('storage/' . $product->main_image) }}"
                        alt="{{ $product->name }}"
                        class="img-fluid rounded"
                        style="width:100%; max-height:450px; object-fit:contain;"
                    >

                @else

                    <div
                        class="d-flex align-items-center justify-content-center bg-light rounded"
                        style="height:400px;"
                    >
                        <span class="text-muted">
                            No Image Available
                        </span>
                    </div>

                @endif

            </div>

        </div>


        {{-- Gallery Images --}}
        @if($product->images && $product->images->count())

            <div class="card shadow-sm mt-3">

                <div class="card-header">
                    <strong>Product Gallery</strong>
                </div>

                <div class="card-body">

                    <div class="row">

                        @foreach($product->images as $image)

                            <div class="col-4 col-md-3 mb-3">

                                <img
                                    src="{{ asset('storage/' . $image->image) }}"
                                    alt="{{ $product->name }}"
                                    class="img-fluid img-thumbnail"
                                    style="height:100px; width:100%; object-fit:cover;"
                                >

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        @endif

    </div>


    {{-- Product Information --}}
    <div class="col-md-6">

        <div class="card shadow-sm">

            <div class="card-body">

                {{-- Category --}}
                @if($product->category)

                    <span class="badge bg-secondary mb-2">
                        {{ $product->category->name }}
                    </span>

                @endif


                {{-- Product Name --}}
                <h1 class="mb-3">
                    {{ $product->name }}
                </h1>


                {{-- SKU --}}
                <p class="text-muted">
                    <strong>SKU:</strong>
                    {{ $product->sku }}
                </p>


                <hr>


                {{-- Price --}}
                <h2 class="text-primary mb-3">
                    ${{ number_format((float) $product->price, 2) }}
                </h2>


                {{-- Order Confirmation --}}
                @if($product->stock > 0)

                    <div class="card border-primary mb-4">

                        <div class="card-body">

                            <h5 class="fw-bold mb-3">
                                Order This Product
                            </h5>

                            <div class="mb-3">
                                <div class="fw-semibold mb-1">
                                    Product Name
                                </div>
                                <div>
                                    {{ $product->name }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="fw-semibold mb-1">
                                    Details
                                </div>
                                <div class="text-muted">
                                    SKU: {{ $product->sku }}<br>
                                    Price: USD ${{ number_format((float) $product->price, 2) }}
                                </div>
                            </div>

                            <form action="{{ route('customer.products.order', $product) }}"
                                  method="POST">

                                @csrf

                                <div class="mb-3">
                                    <label for="customer_name" class="form-label fw-semibold">
                                        Full Name
                                    </label>
                                    <input type="text"
                                           name="customer_name"
                                           id="customer_name"
                                           class="form-control"
                                           value="{{ old('customer_name', auth()->user()->name) }}"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label for="customer_email" class="form-label fw-semibold">
                                        Email Address
                                    </label>
                                    <input type="email"
                                           name="customer_email"
                                           id="customer_email"
                                           class="form-control"
                                           value="{{ old('customer_email', auth()->user()->email) }}"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label for="customer_phone" class="form-label fw-semibold">
                                        Phone Number
                                    </label>
                                    <input type="text"
                                           name="customer_phone"
                                           id="customer_phone"
                                           class="form-control"
                                           value="{{ old('customer_phone') }}"
                                           placeholder="03XX-XXXXXXX">
                                </div>

                                <div class="mb-3">
                                    <label for="shipping_address" class="form-label fw-semibold">
                                        Street / Address
                                    </label>
                                    <textarea name="shipping_address"
                                              id="shipping_address"
                                              class="form-control"
                                              rows="3"
                                              required>{{ old('shipping_address') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="city" class="form-label fw-semibold">
                                        City
                                    </label>
                                    <input type="text"
                                           name="city"
                                           id="city"
                                           class="form-control"
                                           value="{{ old('city') }}"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label for="notes" class="form-label fw-semibold">
                                        Order Notes
                                    </label>
                                    <textarea name="notes"
                                              id="notes"
                                              class="form-control"
                                              rows="2">{{ old('notes') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="quantity" class="form-label fw-semibold">
                                        Quantity
                                    </label>
                                    <input type="number"
                                           name="quantity"
                                           id="quantity"
                                           class="form-control"
                                           min="1"
                                           max="{{ $product->stock }}"
                                           value="1"
                                           required>
                                </div>

                                <button type="submit"
                                        class="btn btn-primary w-100">
                                    Submit Order
                                </button>

                            </form>

                        </div>

                    </div>

                @endif


                {{-- Request Quotation Button --}}
                <div class="mb-4">

                    <a href="{{ route('customer.quotations.create', $product) }}"
                       class="btn btn-outline-primary w-100">
                        Request Quotation
                    </a>

                </div>


                {{-- Wishlist Button --}}
                @php
                    $isWishlisted = \App\Models\Wishlist::where('user_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->exists();
                @endphp

                <div class="mb-4">

                    @if($isWishlisted)

                        <form action="{{ route('customer.wishlist.destroy', $product) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger">
                                ♥ Remove from Wishlist
                            </button>

                        </form>

                    @else

                        <form action="{{ route('customer.wishlist.store', $product) }}"
                              method="POST">

                            @csrf

                            <button type="submit"
                                    class="btn btn-outline-danger">
                                ♡ Add to Wishlist
                            </button>

                        </form>

                    @endif

                </div>


                {{-- Stock --}}
                <div class="mb-3">

                    @if($product->stock > 0)

                        <span class="badge bg-success fs-6">
                            In Stock
                        </span>

                        <span class="ms-2 text-muted">
                            {{ $product->stock }} available
                        </span>

                    @else

                        <span class="badge bg-danger fs-6">
                            Out of Stock
                        </span>

                    @endif

                </div>


                {{-- Featured --}}
                @if($product->is_featured)

                    <div class="mb-3">

                        <span class="badge bg-warning text-dark">
                            ⭐ Featured Product
                        </span>

                    </div>

                @endif


                {{-- Description --}}
                <h5 class="mt-4">
                    Description
                </h5>

                @if($product->description)

                    <p class="text-muted">
                        {!! nl2br(e($product->description)) !!}
                    </p>

                @else

                    <p class="text-muted">
                        No description available.
                    </p>

                @endif


                {{-- Tags --}}
                @if(is_array($product->tags) && count($product->tags))

                    <h5 class="mt-4">
                        Tags
                    </h5>

                    <div>

                        @foreach($product->tags as $tag)

                            <span class="badge bg-primary me-1 mb-1">
                                {{ $tag }}
                            </span>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- Specifications --}}
<div class="card shadow-sm mt-4">

    <div class="card-header">
        <h5 class="mb-0">
            Product Specifications
        </h5>
    </div>

    <div class="card-body">

        @if(is_array($product->specifications) && count($product->specifications))

            <div class="table-responsive">

                <table class="table table-bordered mb-0">

                    <tbody>

                        @foreach($product->specifications as $key => $value)

                            <tr>

                                <th style="width:35%;">
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

            <p class="text-muted mb-0">
                No specifications available.
            </p>

        @endif

    </div>

</div>


{{-- Product Information --}}
<div class="card shadow-sm mt-4 mb-4">

    <div class="card-header">
        <h5 class="mb-0">
            Product Information
        </h5>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-4 mb-3">

                <strong>Product Name</strong>

                <p class="mb-0">
                    {{ $product->name }}
                </p>

            </div>


            <div class="col-md-4 mb-3">

                <strong>Category</strong>

                <p class="mb-0">
                    {{ $product->category->name ?? 'N/A' }}
                </p>

            </div>


            <div class="col-md-4 mb-3">

                <strong>Status</strong>

                <p class="mb-0">

                    @if($product->status)

                        <span class="badge bg-success">
                            Available
                        </span>

                    @else

                        <span class="badge bg-danger">
                            Unavailable
                        </span>

                    @endif

                </p>

            </div>

        </div>

    </div>

</div>
```

</div>

@endsection
