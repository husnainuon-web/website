
@extends('layouts.customer')

@section('title', 'My Quotations')

@section('page-title', 'My Quotations')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                My Quotations
            </h2>

            <p class="text-muted mb-0">
                View and manage your quotation requests.
            </p>
        </div>

        <a href="{{ route('customer.products.index') }}"
           class="btn btn-dark">

            <i class="bi bi-box-seam me-1"></i>
            Browse Products

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


    {{-- Quotations Table --}}
    @if($quotations->count() > 0)

        <div class="card border-0 shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="px-4">
                                    #
                                </th>

                                <th>
                                    Product
                                </th>

                                <th>
                                    Quantity
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Quoted Price
                                </th>

                                <th>
                                    Date
                                </th>

                                <th class="text-end px-4">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($quotations as $quotation)

                                <tr>

                                    {{-- ID --}}
                                    <td class="px-4">

                                        <strong>
                                            #{{ $quotation->id }}
                                        </strong>

                                    </td>


                                    {{-- Product --}}
                                    <td>

                                        <div class="fw-semibold">

                                            {{ $quotation->product->name ?? 'Product Deleted' }}

                                        </div>

                                        @if($quotation->product && $quotation->product->category)

                                            <small class="text-muted">

                                                {{ $quotation->product->category->name }}

                                            </small>

                                        @endif

                                    </td>


                                    {{-- Quantity --}}
                                    <td>

                                        {{ number_format($quotation->quantity) }}

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($quotation->status === 'pending')

                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>

                                        @elseif($quotation->status === 'approved')

                                            <span class="badge bg-success">
                                                Approved
                                            </span>

                                        @elseif($quotation->status === 'rejected')

                                            <span class="badge bg-danger">
                                                Rejected
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ ucfirst($quotation->status) }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Quoted Price --}}
                                    <td>

                                        @if($quotation->quoted_price !== null)

                                            <strong>

                                                $
                                                {{ number_format($quotation->quoted_price, 2) }}

                                            </strong>

                                        @else

                                            <span class="text-muted">
                                                Not quoted yet
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Date --}}
                                    <td>

                                        {{ $quotation->created_at->format('d M Y') }}

                                    </td>


                                    {{-- Action --}}
                                    <td class="text-end px-4">

                                        <a
                                            href="{{ route('customer.quotations.show', $quotation) }}"
                                            class="btn btn-sm btn-outline-dark"
                                        >

                                            <i class="bi bi-eye me-1"></i>

                                            View

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- Pagination --}}
        @if($quotations->hasPages())

            <div class="mt-4">

                {{ $quotations->links() }}

            </div>

        @endif


    @else

        {{-- Empty State --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <div style="font-size: 60px;">
                    📄
                </div>

                <h4 class="fw-bold mt-3">
                    No Quotations Yet
                </h4>

                <p class="text-muted">
                    You have not submitted any quotation requests yet.
                </p>

                <a
                    href="{{ route('customer.products.index') }}"
                    class="btn btn-dark mt-2"
                >

                    <i class="bi bi-search me-1"></i>

                    Browse Products

                </a>

            </div>

        </div>

    @endif

</div>

@endsection
