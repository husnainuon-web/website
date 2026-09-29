@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Customers</h2>
            <p class="text-muted mb-0">Manage all registered customers.</p>
        </div>

        <div class="badge bg-primary fs-6 px-3 py-2">
            Total: {{ $customers->total() }}
        </div>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">All Customers</h5>
        </div>

        <div class="card-body p-0">

            @if($customers->count() > 0)

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registered</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($customers as $customer)

                                <tr>

                                    <td>
                                        {{ $customers->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $customer->name }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $customer->email }}
                                    </td>

                                    <td>
                                        {{ $customer->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.customers.show', $customer->id) }}"
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

                <div class="text-center py-5">
                    <h5>No Customers Found</h5>
                    <p class="text-muted mb-0">
                        There are currently no registered customers.
                    </p>
                </div>

            @endif

        </div>

        @if($customers->hasPages())
            <div class="card-footer bg-white">
                {{ $customers->links() }}
            </div>
        @endif

    </div>

</div>

@endsection