
@extends('layouts.customer')

@section('title', 'Notifications')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Notifications</h2>
            <p class="text-muted mb-0">
                Stay updated with the latest updates from Zain Manufacturing.
            </p>
        </div>

        @if($notifications->count() > 0)
            <form action="{{ route('customer.notifications.readAll') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-dark">
                    Mark All as Read
                </button>
            </form>
        @endif
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- Notifications List --}}
    @forelse($notifications as $notification)

        @php
            $data = $notification->data;
        @endphp

        <div class="card border-0 shadow-sm mb-3
            {{ is_null($notification->read_at) ? 'border-start border-primary border-4' : '' }}">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div class="d-flex">

                        {{-- Icon --}}
                        <div class="me-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle
                                        d-flex align-items-center justify-content-center"
                                 style="width:50px; height:50px;">

                                @if(($data['type'] ?? '') === 'new_product')
                                    <span style="font-size:24px;">📦</span>
                                @else
                                    <span style="font-size:24px;">🔔</span>
                                @endif

                            </div>
                        </div>


                        {{-- Content --}}
                        <div>

                            <h5 class="fw-bold mb-1">

                                {{ $data['title'] ?? 'Notification' }}

                                @if(is_null($notification->read_at))
                                    <span class="badge bg-primary ms-2">
                                        New
                                    </span>
                                @endif

                            </h5>

                            <p class="text-muted mb-2">
                                {{ $data['message'] ?? '' }}
                            </p>

                            <small class="text-muted">
                                {{ $notification->created_at->diffForHumans() }}
                            </small>

                        </div>

                    </div>


                    {{-- Read Status --}}
                    <div>

                        @if(is_null($notification->read_at))

                            <form
                                action="{{ route('customer.notifications.read', $notification->id) }}"
                                method="POST">

                                @csrf

                                <button type="submit"
                                        class="btn btn-sm btn-outline-primary">
                                    Mark as Read
                                </button>

                            </form>

                        @else

                            <span class="badge bg-light text-success">
                                ✓ Read
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    @empty

        {{-- No Notifications --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <div style="font-size:50px;">
                    🔔
                </div>

                <h4 class="fw-bold mt-3">
                    No Notifications
                </h4>

                <p class="text-muted mb-0">
                    You don't have any notifications yet.
                </p>

            </div>

        </div>

    @endforelse


    {{-- Pagination --}}
    @if($notifications->hasPages())

        <div class="mt-4">
            {{ $notifications->links() }}
        </div>

    @endif

</div>

@endsection

