
@extends('layouts.customer')

@section('title', 'Create Support Request')

@section('page-title', 'Create Support Request')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="mb-4">

        <div class="d-flex align-items-center gap-2 mb-2">

            <a
                href="{{ route('customer.support.index') }}"
                class="btn btn-sm btn-outline-secondary"
            >
                <i class="bi bi-arrow-left"></i>
            </a>

            <h2 class="fw-bold mb-0">
                Create Support Request
            </h2>

        </div>

        <p class="text-muted mb-0">
            Tell us how we can help you.
        </p>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="alert alert-danger border-0 shadow-sm">

            <div class="fw-bold mb-2">
                Please fix the following errors:
            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Support Form --}}
    <div class="row">

        <div class="col-xl-8 col-lg-10">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <form
                        method="POST"
                        action="{{ route('customer.support.store') }}"
                    >

                        @csrf


                        {{-- Subject --}}
                        <div class="mb-4">

                            <label
                                for="subject"
                                class="form-label fw-semibold"
                            >
                                Subject
                            </label>

                            <input
                                type="text"
                                name="subject"
                                id="subject"
                                class="form-control @error('subject') is-invalid @enderror"
                                value="{{ old('subject') }}"
                                placeholder="e.g. Order delivery issue"
                                maxlength="255"
                                required
                            >

                            @error('subject')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Message --}}
                        <div class="mb-4">

                            <label
                                for="message"
                                class="form-label fw-semibold"
                            >
                                Message
                            </label>

                            <textarea
                                name="message"
                                id="message"
                                rows="7"
                                class="form-control @error('message') is-invalid @enderror"
                                placeholder="Describe your problem or question..."
                                maxlength="5000"
                                required
                            >{{ old('message') }}</textarea>

                            @error('message')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                            <div class="form-text">
                                Please provide enough detail so our support team can help you quickly.
                            </div>

                        </div>


                        {{-- Buttons --}}
                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary px-4"
                            >

                                <i class="bi bi-send me-1"></i>

                                Submit Request

                            </button>


                            <a
                                href="{{ route('customer.support.index') }}"
                                class="btn btn-outline-secondary px-4"
                            >

                                Cancel

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- Help Information --}}
        <div class="col-xl-4 col-lg-10 mt-4 mt-xl-0">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center mb-3">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-circle bg-light me-3"
                            style="width: 50px; height: 50px;"
                        >

                            <i
                                class="bi bi-headset text-primary"
                                style="font-size: 24px;"
                            ></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Need Help?
                            </h5>

                            <small class="text-muted">
                                We're here for you.
                            </small>

                        </div>

                    </div>


                    <p class="text-muted">
                        You can contact our support team for help with:
                    </p>


                    <ul class="list-group list-group-flush">

                        <li class="list-group-item px-0">
                            <i class="bi bi-box-seam text-primary me-2"></i>
                            Order problems
                        </li>

                        <li class="list-group-item px-0">
                            <i class="bi bi-truck text-primary me-2"></i>
                            Delivery issues
                        </li>

                        <li class="list-group-item px-0">
                            <i class="bi bi-box text-primary me-2"></i>
                            Product questions
                        </li>

                        <li class="list-group-item px-0">
                            <i class="bi bi-person text-primary me-2"></i>
                            Account problems
                        </li>

                        <li class="list-group-item px-0">
                            <i class="bi bi-question-circle text-primary me-2"></i>
                            General questions
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
