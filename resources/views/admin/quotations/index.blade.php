@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Quotations
            </h2>

            <p class="text-muted mb-0">
                Manage customer quotation requests.
            </p>
        </div>

        <span class="badge bg-primary fs-6 px-3 py-2">
            Total: {{ $quotations->total() }}
        </span>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Error Message --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Quotations Table --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">

            <h5 class="fw-bold mb-0">
                All Quotation Requests
            </h5>

        </div>


        <div class="card-body p-0">

            @if($quotations->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>

                                <th>Customer</th>

                                <th>Email</th>

                                <th>Product</th>

                                <th>Quantity</th>

                                <th>Status</th>

                                <th>Date</th>

                                <th>Action</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($quotations as $quotation)

                                <tr>

                                    {{-- Number --}}
                                    <td>
                                        {{ $quotations->firstItem() + $loop->index }}
                                    </td>


                                    {{-- Customer --}}
                                    <td>

                                        @if($quotation->user)

                                            <strong>
                                                {{ $quotation->user->name }}
                                            </strong>

                                        @else

                                            <span class="text-muted">
                                                N/A
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Email --}}
                                    <td>

                                        @if($quotation->user)

                                            {{ $quotation->user->email }}

                                        @else

                                            <span class="text-muted">
                                                N/A
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Product --}}
                                    <td>

                                        @if($quotation->product)

                                            <strong>
                                                {{ $quotation->product->name }}
                                            </strong>

                                        @else

                                            <span class="text-muted">
                                                Product Deleted
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Quantity --}}
                                    <td>

                                        @if(isset($quotation->quantity))

                                            {{ $quotation->quantity }}

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

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

                                        @elseif($quotation->status === 'completed')

                                            <span class="badge bg-primary">
                                                Completed
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ ucfirst($quotation->status) }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Date --}}
                                    <td>

                                        @if($quotation->created_at)

                                            {{ $quotation->created_at->format('d M Y') }}

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- Action --}}
                                    <td>

                                        <a href="{{ route('admin.quotations.show', $quotation->id) }}"
                                           class="btn btn-sm btn-primary">

                                            View

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                {{-- Empty State --}}

                <div class="text-center py-5">

                    <div class="mb-3">

                        <span style="font-size: 50px;">
                            📄
                        </span>

                    </div>

                    <h5 class="fw-bold">
                        No Quotations Found
                    </h5>

                    <p class="text-muted mb-0">
                        There are currently no customer quotation requests.
                    </p>

                </div>

            @endif

        </div>


        {{-- Pagination --}}
        @if($quotations->hasPages())

            <div class="card-footer bg-white">

                {{ $quotations->links() }}

            </div>

        @endif

    </div>

</div>

@endsection