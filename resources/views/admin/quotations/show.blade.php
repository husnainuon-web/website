@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Quotation Details
            </h2>

            <p class="text-muted mb-0">
                View and manage customer quotation request.
            </p>
        </div>

        <a href="{{ route('admin.quotations.index') }}"
           class="btn btn-secondary">
            ← Back to Quotations
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


    <div class="row">

        {{-- Customer Information --}}
        <div class="col-md-5 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white py-3">

                    <h5 class="fw-bold mb-0">
                        Customer Information
                    </h5>

                </div>

                <div class="card-body">

                    @if($quotation->user)

                        <div class="text-center mb-4">

                            <div class="rounded-circle bg-primary text-white
                                        d-flex align-items-center justify-content-center
                                        mx-auto mb-3"
                                 style="width:80px;height:80px;font-size:32px;">

                                {{ strtoupper(substr($quotation->user->name, 0, 1)) }}

                            </div>

                            <h5 class="fw-bold mb-1">
                                {{ $quotation->user->name }}
                            </h5>

                            <p class="text-muted mb-0">
                                Customer
                            </p>

                        </div>


                        <div class="border rounded p-3 mb-3">

                            <small class="text-muted d-block">
                                Name
                            </small>

                            <strong>
                                {{ $quotation->user->name }}
                            </strong>

                        </div>


                        <div class="border rounded p-3 mb-3">

                            <small class="text-muted d-block">
                                Email
                            </small>

                            <strong>
                                {{ $quotation->user->email }}
                            </strong>

                        </div>


                        <div class="border rounded p-3">

                            <small class="text-muted d-block">
                                Customer ID
                            </small>

                            <strong>
                                #{{ $quotation->user->id }}
                            </strong>

                        </div>

                    @else

                        <div class="alert alert-warning mb-0">
                            Customer information is not available.
                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- Quotation Information --}}
        <div class="col-md-7 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white py-3">

                    <h5 class="fw-bold mb-0">
                        Quotation Information
                    </h5>

                </div>

                <div class="card-body">

                    {{-- Product --}}
                    <div class="border rounded p-3 mb-3">

                        <small class="text-muted d-block">
                            Product
                        </small>

                        @if($quotation->product)

                            <h5 class="fw-bold mb-0">
                                {{ $quotation->product->name }}
                            </h5>

                        @else

                            <span class="text-muted">
                                Product Deleted
                            </span>

                        @endif

                    </div>


                    <div class="row">

                        {{-- Quantity --}}
                        <div class="col-md-6 mb-3">

                            <div class="border rounded p-3">

                                <small class="text-muted d-block">
                                    Quantity
                                </small>

                                <strong>
                                    {{ $quotation->quantity ?? '-' }}
                                </strong>

                            </div>

                        </div>


                        {{-- Date --}}
                        <div class="col-md-6 mb-3">

                            <div class="border rounded p-3">

                                <small class="text-muted d-block">
                                    Requested Date
                                </small>

                                <strong>
                                    {{ $quotation->created_at?->format('d M Y, h:i A') ?? '-' }}
                                </strong>

                            </div>

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="border rounded p-3 mb-3">

                        <small class="text-muted d-block mb-2">
                            Current Status
                        </small>

                        @if($quotation->status === 'pending')

                            <span class="badge bg-warning text-dark px-3 py-2">
                                Pending
                            </span>

                        @elseif($quotation->status === 'approved')

                            <span class="badge bg-success px-3 py-2">
                                Approved
                            </span>

                        @elseif($quotation->status === 'rejected')

                            <span class="badge bg-danger px-3 py-2">
                                Rejected
                            </span>

                        @elseif($quotation->status === 'completed')

                            <span class="badge bg-primary px-3 py-2">
                                Completed
                            </span>

                        @else

                            <span class="badge bg-secondary px-3 py-2">
                                {{ ucfirst($quotation->status) }}
                            </span>

                        @endif

                    </div>


                    {{-- Message --}}
                    @if(isset($quotation->message) && $quotation->message)

                        <div class="border rounded p-3 mb-3">

                            <small class="text-muted d-block mb-2">
                                Customer Message
                            </small>

                            <p class="mb-0">
                                {{ $quotation->message }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- Update Status --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">

            <h5 class="fw-bold mb-0">
                Update Quotation Status
            </h5>

        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('admin.quotations.update', $quotation->id) }}">

                @csrf
                @method('PUT')

                <div class="row align-items-end">

                    <div class="col-md-8">

                        <label for="status"
                               class="form-label fw-bold">
                            Status
                        </label>

                        <select name="status"
                                id="status"
                                class="form-select"
                                required>

                            <option value="pending"
                                {{ $quotation->status === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="approved"
                                {{ $quotation->status === 'approved' ? 'selected' : '' }}>
                                Approved
                            </option>

                            <option value="rejected"
                                {{ $quotation->status === 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>

                            <option value="completed"
                                {{ $quotation->status === 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                        </select>

                    </div>


                    <div class="col-md-4 mt-3 mt-md-0">

                        <button type="submit"
                                class="btn btn-primary w-100">

                            Update Status

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection