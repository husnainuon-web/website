
@extends('layouts.admin')

@section('title', 'Support Tickets')

@section('page-title', 'Support Tickets')

@section('content')

<div class="container-fluid py-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-headset me-2"></i>
                Support Tickets
            </h2>

            <p class="text-muted mb-0">
                Manage customer support requests.
            </p>
        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Tickets Card --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">
                All Support Tickets
            </h5>

        </div>


        <div class="card-body p-0">

            @if($tickets->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>

                                <th>Customer</th>

                                <th>Email</th>

                                <th>Subject</th>

                                <th>Status</th>

                                <th>Date</th>

                                <th class="text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($tickets as $ticket)

                                <tr>

                                    {{-- Ticket ID --}}
                                    <td>
                                        <strong>
                                            #{{ $ticket->id }}
                                        </strong>
                                    </td>


                                    {{-- Customer Name --}}
                                    <td>
                                        {{ $ticket->user->name ?? 'N/A' }}
                                    </td>


                                    {{-- Customer Email --}}
                                    <td>
                                        {{ $ticket->user->email ?? 'N/A' }}
                                    </td>


                                    {{-- Subject --}}
                                    <td>
                                        {{ $ticket->subject }}
                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($ticket->status === 'pending')

                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>

                                        @elseif($ticket->status === 'in_progress')

                                            <span class="badge bg-info text-dark">
                                                In Progress
                                            </span>

                                        @elseif($ticket->status === 'resolved')

                                            <span class="badge bg-success">
                                                Resolved
                                            </span>

                                        @elseif($ticket->status === 'closed')

                                            <span class="badge bg-dark">
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
                                    </td>


                                    {{-- View Button --}}
                                    <td class="text-center">

                                        <a
                                            href="{{ route('admin.support.show', $ticket) }}"
                                            class="btn btn-sm btn-primary"
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


                {{-- Pagination --}}
                <div class="p-3">

                    {{ $tickets->links() }}

                </div>


            @else

                {{-- No Tickets --}}
                <div class="text-center py-5">

                    <i
                        class="bi bi-inbox"
                        style="font-size: 50px;"
                    ></i>

                    <h5 class="mt-3">
                        No Support Tickets
                    </h5>

                    <p class="text-muted mb-0">
                        There are currently no customer support requests.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection

