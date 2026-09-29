
@extends('layouts.customer')

@section('title', 'Support')

@section('page-title', 'Support')

@section('content')

<div class="container-fluid py-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Support
            </h2>

            <p class="text-muted mb-0">
                Get help from our support team.
            </p>
        </div>

        <a
            href="{{ route('customer.support.create') }}"
            class="btn btn-primary"
        >
            <i class="bi bi-plus-circle me-1"></i>
            New Support Request
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- Error Message --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- Support Tickets --}}
    @if($tickets->count() > 0)

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-0 py-3">

                <h5 class="fw-bold mb-0">
                    My Support Requests
                </h5>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="px-4 py-3">
                                    #
                                </th>

                                <th>
                                    Subject
                                </th>

                                <th>
                                    Status
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

                            @foreach($tickets as $ticket)

                                <tr>

                                    {{-- ID --}}
                                    <td class="px-4">

                                        <span class="fw-bold">
                                            #{{ $ticket->id }}
                                        </span>

                                    </td>


                                    {{-- Subject --}}
                                    <td>

                                        <div class="fw-semibold">
                                            {{ $ticket->subject }}
                                        </div>

                                        <div class="text-muted small">

                                            {{ \Illuminate\Support\Str::limit($ticket->message, 70) }}

                                        </div>

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($ticket->status === 'pending')

                                            <span class="badge bg-warning text-dark">

                                                <i class="bi bi-clock me-1"></i>

                                                Pending

                                            </span>

                                        @elseif($ticket->status === 'in_progress')

                                            <span class="badge bg-info text-dark">

                                                <i class="bi bi-hourglass-split me-1"></i>

                                                In Progress

                                            </span>

                                        @elseif($ticket->status === 'resolved')

                                            <span class="badge bg-success">

                                                <i class="bi bi-check-circle me-1"></i>

                                                Resolved

                                            </span>

                                        @elseif($ticket->status === 'closed')

                                            <span class="badge bg-secondary">

                                                <i class="bi bi-x-circle me-1"></i>

                                                Closed

                                            </span>

                                        @else

                                            <span class="badge bg-secondary">

                                                {{ ucfirst($ticket->status) }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Date --}}
                                    <td>

                                        {{ $ticket->created_at->format('d M Y') }}

                                        <div class="text-muted small">

                                            {{ $ticket->created_at->format('h:i A') }}

                                        </div>

                                    </td>


                                    {{-- Action --}}
                                    <td class="text-end px-4">

                                        <a
                                            href="{{ route('customer.support.show', $ticket) }}"
                                            class="btn btn-sm btn-outline-primary"
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
        <div class="mt-4">

            {{ $tickets->links() }}

        </div>


    @else

        {{-- No Support Requests --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <div
                    class="d-flex align-items-center justify-content-center mx-auto mb-4 rounded-circle bg-light"
                    style="width: 90px; height: 90px;"
                >

                    <i
                        class="bi bi-headset text-primary"
                        style="font-size: 42px;"
                    ></i>

                </div>


                <h4 class="fw-bold mb-2">
                    No Support Requests
                </h4>


                <p class="text-muted mb-4">

                    You haven't submitted any support requests yet.

                    If you need help with an order, product, account,
                    delivery, or anything else, we're here to help.

                </p>


                <a
                    href="{{ route('customer.support.create') }}"
                    class="btn btn-primary px-4"
                >

                    <i class="bi bi-plus-circle me-1"></i>

                    Create Support Request

                </a>

            </div>

        </div>

    @endif

</div>

@endsection

