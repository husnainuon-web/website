@extends('layouts.admin')

@section('title', 'Customer Details')

@section('page-title', 'Customer Details')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Customer Details</h2>
            <p class="text-muted mb-0">
                View customer information.
            </p>
        </div>

        <a href="{{ route('admin.customers.index') }}"
           class="btn btn-secondary">
            ← Back to Customers
        </a>
    </div>


    <div class="row">

        <!-- Customer Profile -->
        <div class="col-md-4 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center py-4">

                    <div class="rounded-circle bg-primary text-white
                                d-flex align-items-center justify-content-center
                                mx-auto mb-3"
                         style="width: 90px; height: 90px; font-size: 36px;">

                        {{ strtoupper(substr($user->name, 0, 1)) }}

                    </div>

                    <h4 class="fw-bold mb-1">
                        {{ $user->name }}
                    </h4>

                    <p class="text-muted mb-3">
                        Customer
                    </p>

                    <span class="badge bg-success px-3 py-2">
                        Active
                    </span>

                </div>

            </div>

        </div>


        <!-- Customer Information -->
        <div class="col-md-8 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">
                        Customer Information
                    </h5>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-4">
                            <small class="text-muted d-block">
                                Full Name
                            </small>

                            <strong>
                                {{ $user->name }}
                            </strong>
                        </div>


                        <div class="col-md-6 mb-4">
                            <small class="text-muted d-block">
                                Email Address
                            </small>

                            <strong>
                                {{ $user->email }}
                            </strong>
                        </div>


                        <div class="col-md-6 mb-4">
                            <small class="text-muted d-block">
                                Account Role
                            </small>

                            <strong>
                                {{ ucfirst($user->role) }}
                            </strong>
                        </div>


                        <div class="col-md-6 mb-4">
                            <small class="text-muted d-block">
                                Registered Date
                            </small>

                            <strong>
                                {{ $user->created_at->format('d M Y, h:i A') }}
                            </strong>
                        </div>


                        <div class="col-md-6 mb-4">
                            <small class="text-muted d-block">
                                Last Updated
                            </small>

                            <strong>
                                {{ $user->updated_at->format('d M Y, h:i A') }}
                            </strong>
                        </div>


                        <div class="col-md-6 mb-4">
                            <small class="text-muted d-block">
                                Customer ID
                            </small>

                            <strong>
                                #{{ $user->id }}
                            </strong>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Account Summary -->

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">
                Account Summary
            </h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-3">
                    <div class="border rounded p-3">
                        <small class="text-muted d-block">
                            Customer ID
                        </small>

                        <h5 class="fw-bold mb-0">
                            #{{ $user->id }}
                        </h5>
                    </div>
                </div>


                <div class="col-md-4 mb-3">
                    <div class="border rounded p-3">
                        <small class="text-muted d-block">
                            Account Status
                        </small>

                        <h5 class="fw-bold text-success mb-0">
                            Active
                        </h5>
                    </div>
                </div>


                <div class="col-md-4 mb-3">
                    <div class="border rounded p-3">
                        <small class="text-muted d-block">
                            Account Type
                        </small>

                        <h5 class="fw-bold mb-0">
                            Customer
                        </h5>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection