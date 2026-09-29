@extends('layouts.customer')

@section('title', 'Profile')

@section('page-title', 'Profile')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-xl-8 col-lg-10">

            <div class="card shadow-sm border-0">

                <div class="card-body p-4 p-md-5">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <h3 class="fw-bold mb-1">My Profile</h3>

                            <p class="text-muted mb-0">
                                Manage your personal information.
                            </p>

                        </div>

                        <span class="badge bg-primary-subtle text-primary px-3 py-2">
                            Customer
                        </span>

                    </div>

                    @if(session('success'))

                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>

                    @endif

                    <form action="{{ route('customer.profile.update') }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="{{ old('name', $customer->name) }}"
                                       required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       value="{{ old('email', $customer->email) }}"
                                       required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text"
                                       name="phone"
                                       class="form-control"
                                       value="{{ old('phone', $customer->phone ?? '') }}"
                                       placeholder="Enter phone number">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input type="text"
                                       name="city"
                                       class="form-control"
                                       value="{{ old('city', $customer->city ?? '') }}"
                                       placeholder="Enter city">
                                @error('city')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <textarea name="address"
                                          class="form-control"
                                          rows="4"
                                          placeholder="Enter full address">{{ old('address', $customer->address ?? '') }}</textarea>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                Save Changes
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
