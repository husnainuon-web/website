@extends('layouts.admin')

@section('title', 'Customers')

@section('page-title', 'Customers')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Customers</h2>
            <p class="text-muted mb-0">
                Manage all registered customers.
            </p>
        </div>

        <div class="bg-dark text-white px-3 py-2 rounded-3">
            Total Customers: {{ $customers->total() }}
        </div>
    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0 fw-bold">
                All Customers
            </h5>
        </div>

        <div class="card-body">

            @if($customers->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Registered</th>
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
                                        <strong>{{ $customer->name }}</strong>
                                    </td>

                                    <td>{{ $customer->email }}</td>

                                    <td>
                                        <span class="badge bg-success text-white">
                                            {{ ucfirst($customer->role) }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $customer->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.customers.show', $customer) }}"
                                           class="btn btn-sm btn-dark">
                                            View
                                        </a>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-4">
                    {{ $customers->links() }}
                </div>

            @else

                <div class="text-center py-5">
                    <div style="font-size: 60px;">👤</div>
                    <h4 class="fw-bold mt-3">No Customers Yet</h4>
                    <p class="text-muted">
                        Registered customers will appear here.
                    </p>
                </div>

            @endif

        </div>

    </div>

</div>

<style>
    .card {
        border-radius: 16px;
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        white-space: nowrap;
    }

    .table td {
        vertical-align: middle;
    }

    .badge {
        padding: 7px 10px;
        border-radius: 8px;
    }

    .btn-dark {
        border-radius: 8px;
    }
</style>

@endsection
