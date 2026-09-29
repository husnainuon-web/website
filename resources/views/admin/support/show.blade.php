@extends('layouts.admin')

@section('title', 'Support Ticket')

@section('page-title', 'Support Ticket')

@section('content')

<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Support Ticket
            </h2>

            <p class="text-muted mb-0">
                View customer request and send a reply.
            </p>
        </div>

        <a
            href="{{ route('admin.support.index') }}"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-left"></i>
            Back to Tickets
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>

    @endif


    {{-- Validation Errors --}}
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


    <div class="row g-4">


        {{-- LEFT SIDE --}}
        <div class="col-lg-7">

            {{-- Customer Information --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-person me-2"></i>
                        Customer Information
                    </h5>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <small class="text-muted">
                                Customer Name
                            </small>

                            <div class="fw-semibold">
                                {{ $supportTicket->user->name ?? 'Unknown Customer' }}
                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <small class="text-muted">
                                Email
                            </small>

                            <div class="fw-semibold">
                                {{ $supportTicket->user->email ?? 'N/A' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Customer Message --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 py-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-chat-left-text me-2"></i>
                            Customer Request
                        </h5>


                        @if($supportTicket->status === 'pending')

                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>

                        @elseif($supportTicket->status === 'in_progress')

                            <span class="badge bg-info text-dark">
                                In Progress
                            </span>

                        @elseif($supportTicket->status === 'resolved')

                            <span class="badge bg-success">
                                Resolved
                            </span>

                        @elseif($supportTicket->status === 'closed')

                            <span class="badge bg-secondary">
                                Closed
                            </span>

                        @else

                            <span class="badge bg-dark">
                                {{ ucfirst($supportTicket->status) }}
                            </span>

                        @endif

                    </div>

                </div>


                <div class="card-body">

                    {{-- Subject --}}
                    <div class="mb-4">

                        <small class="text-muted">
                            Subject
                        </small>

                        <h5 class="fw-bold mt-1">
                            {{ $supportTicket->subject }}
                        </h5>

                    </div>


                    {{-- Message --}}
                    <div>

                        <small class="text-muted">
                            Message
                        </small>

                        <div
                            class="mt-2 p-3 rounded"
                            style="background:#f8f9fa; white-space:pre-line;"
                        >
                            {{ $supportTicket->message }}
                        </div>

                    </div>


                    {{-- Date --}}
                    <div class="mt-4">

                        <small class="text-muted">

                            Submitted:

                            {{ $supportTicket->created_at->format('d M Y, h:i A') }}

                        </small>

                    </div>

                </div>

            </div>

        </div>


        {{-- RIGHT SIDE --}}
        <div class="col-lg-5">

            {{-- Admin Reply --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-dark text-white py-3">

                    <h5 class="mb-0 fw-bold">

                        <i class="bi bi-reply me-2"></i>

                        Admin Response

                    </h5>

                </div>


                <div class="card-body">

                    <form
                        method="POST"
                        action="{{ route('admin.support.update', $supportTicket) }}"
                    >

                        @csrf

                        @method('PUT')


                        {{-- Status --}}
                        <div class="mb-4">

                            <label
                                for="status"
                                class="form-label fw-semibold"
                            >
                                Ticket Status
                            </label>

                            <select
                                name="status"
                                id="status"
                                class="form-select"
                                required
                            >

                                <option
                                    value="pending"
                                    {{ $supportTicket->status === 'pending' ? 'selected' : '' }}
                                >
                                    Pending
                                </option>

                                <option
                                    value="in_progress"
                                    {{ $supportTicket->status === 'in_progress' ? 'selected' : '' }}
                                >
                                    In Progress
                                </option>

                                <option
                                    value="resolved"
                                    {{ $supportTicket->status === 'resolved' ? 'selected' : '' }}
                                >
                                    Resolved
                                </option>

                                <option
                                    value="closed"
                                    {{ $supportTicket->status === 'closed' ? 'selected' : '' }}
                                >
                                    Closed
                                </option>

                            </select>

                        </div>


                        {{-- Admin Reply --}}
                        <div class="mb-4">

                            <label
                                for="admin_reply"
                                class="form-label fw-semibold"
                            >
                                Reply to Customer
                            </label>

                            <textarea
                                name="admin_reply"
                                id="admin_reply"
                                rows="8"
                                class="form-control"
                                placeholder="Write your response to the customer..."
                            >{{ old('admin_reply', $supportTicket->admin_reply) }}</textarea>

                            <small class="text-muted">
                                Maximum 5000 characters.
                            </small>

                        </div>


                        {{-- Submit --}}
                        <button
                            type="submit"
                            class="btn btn-dark w-100"
                        >

                            <i class="bi bi-send me-2"></i>

                            Update Ticket

                        </button>

                    </form>

                </div>

            </div>


            {{-- Existing Reply --}}
            @if($supportTicket->admin_reply)

                <div class="card border-0 shadow-sm mt-4">

                    <div class="card-header bg-white border-0 py-3">

                        <h6 class="fw-bold mb-0">

                            <i class="bi bi-chat-right-text me-2"></i>

                            Current Admin Reply

                        </h6>

                    </div>


                    <div class="card-body">

                        <div
                            class="p-3 rounded"
                            style="background:#f8f9fa; white-space:pre-line;"
                        >
                            {{ $supportTicket->admin_reply }}
                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection