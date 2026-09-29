
@extends('layouts.customer')

@section('title', 'Support Request')

@section('page-title', 'Support Request')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex align-items-center gap-2 mb-4">

        <a
            href="{{ route('customer.support.index') }}"
            class="btn btn-sm btn-outline-secondary"
        >
            <i class="bi bi-arrow-left"></i>
        </a>

        <div>
            <h2 class="fw-bold mb-1">
                Support Request #{{ $supportTicket->id }}
            </h2>

            <p class="text-muted mb-0">
                View your support request and response.
            </p>
        </div>

    </div>


    <div class="row g-4">

        {{-- Main Request --}}
        <div class="col-xl-8 col-lg-12">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    {{-- Subject --}}
                    <div class="mb-4">

                        <div class="text-muted small mb-1">
                            Subject
                        </div>

                        <h4 class="fw-bold mb-0">
                            {{ $supportTicket->subject }}
                        </h4>

                    </div>


                    {{-- Status --}}
                    <div class="mb-4">

                        <div class="text-muted small mb-2">
                            Status
                        </div>

                        @if($supportTicket->status === 'pending')

                            <span class="badge bg-warning text-dark px-3 py-2">
                                <i class="bi bi-clock me-1"></i>
                                Pending
                            </span>

                        @elseif($supportTicket->status === 'in_progress')

                            <span class="badge bg-info text-dark px-3 py-2">
                                <i class="bi bi-hourglass-split me-1"></i>
                                In Progress
                            </span>

                        @elseif($supportTicket->status === 'resolved')

                            <span class="badge bg-success px-3 py-2">
                                <i class="bi bi-check-circle me-1"></i>
                                Resolved
                            </span>

                        @elseif($supportTicket->status === 'closed')

                            <span class="badge bg-secondary px-3 py-2">
                                <i class="bi bi-x-circle me-1"></i>
                                Closed
                            </span>

                        @else

                            <span class="badge bg-secondary px-3 py-2">
                                {{ ucfirst($supportTicket->status) }}
                            </span>

                        @endif

                    </div>


                    <hr>


                    {{-- Customer Message --}}
                    <div class="mb-4">

                        <div class="d-flex align-items-center mb-3">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white me-2"
                                style="width: 40px; height: 40px;"
                            >

                                <i class="bi bi-person"></i>

                            </div>

                            <div>

                                <div class="fw-bold">
                                    Your Message
                                </div>

                                <div class="text-muted small">
                                    {{ $supportTicket->created_at->format('d M Y, h:i A') }}
                                </div>

                            </div>

                        </div>


                        <div class="bg-light rounded p-4">

                            <p class="mb-0" style="white-space: pre-line;">
                                {{ $supportTicket->message }}
                            </p>

                        </div>

                    </div>


                    {{-- Admin Reply --}}
                    <div>

                        <div class="d-flex align-items-center mb-3">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-dark text-white me-2"
                                style="width: 40px; height: 40px;"
                            >

                                <i class="bi bi-headset"></i>

                            </div>

                            <div>

                                <div class="fw-bold">
                                    Support Team
                                </div>

                                <div class="text-muted small">
                                    Admin Response
                                </div>

                            </div>

                        </div>


                        @if($supportTicket->admin_reply)

                            <div class="border rounded p-4">

                                <p
                                    class="mb-0"
                                    style="white-space: pre-line;"
                                >
                                    {{ $supportTicket->admin_reply }}
                                </p>

                            </div>

                        @else

                            <div class="alert alert-info border-0">

                                <i class="bi bi-info-circle me-2"></i>

                                Our support team hasn't replied yet.
                                We will respond as soon as possible.

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- Request Information --}}
        <div class="col-xl-4 col-lg-12">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="fw-bold mb-0">
                        Request Information
                    </h5>

                </div>


                <div class="card-body">

                    {{-- Request ID --}}
                    <div class="mb-3">

                        <div class="text-muted small">
                            Request ID
                        </div>

                        <div class="fw-semibold">
                            #{{ $supportTicket->id }}
                        </div>

                    </div>


                    {{-- Created --}}
                    <div class="mb-3">

                        <div class="text-muted small">
                            Created
                        </div>

                        <div class="fw-semibold">
                            {{ $supportTicket->created_at->format('d M Y') }}
                        </div>

                        <div class="text-muted small">
                            {{ $supportTicket->created_at->format('h:i A') }}
                        </div>

                    </div>


                    {{-- Last Updated --}}
                    <div class="mb-3">

                        <div class="text-muted small">
                            Last Updated
                        </div>

                        <div class="fw-semibold">
                            {{ $supportTicket->updated_at->format('d M Y') }}
                        </div>

                        <div class="text-muted small">
                            {{ $supportTicket->updated_at->format('h:i A') }}
                        </div>

                    </div>


                    {{-- Status --}}
                    <div>

                        <div class="text-muted small mb-2">
                            Current Status
                        </div>

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

                            <span class="badge bg-secondary">
                                {{ ucfirst($supportTicket->status) }}
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Back Button --}}
            <div class="mt-3">

                <a
                    href="{{ route('customer.support.index') }}"
                    class="btn btn-outline-primary w-100"
                >

                    <i class="bi bi-arrow-left me-1"></i>

                    Back to Support

                </a>

            </div>

        </div>

    </div>

</div>

@endsection

