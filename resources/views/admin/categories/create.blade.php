@extends('layouts.admin')

@section('title', 'Create Category')

@section('page-title', 'Add Category')

@section('content')

<div class="container-fluid px-0">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                <i class="bi bi-plus-circle me-2"></i>
                Create New Category
            </h4>

            <p class="text-muted mb-0">
                Add a new product category to your store.
            </p>
        </div>

        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left me-2"></i>
            Back to Categories
        </a>

    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    <div class="col-lg-8">

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Category Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                placeholder="Enter category name"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea
                                name="description"
                                id="description"
                                class="form-control"
                                rows="6"
                                placeholder="Write a short description for this category"
                            >{{ old('description') }}</textarea>
                        </div>

                    </div>

                    <div class="col-lg-4">

                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">Category Image</label>
                            <input
                                type="file"
                                name="image"
                                id="image"
                                class="form-control"
                                accept="image/*"
                            >
                        </div>

                        <div class="card bg-light border-0 rounded-4">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-image fs-1 text-muted"></i>
                                <p class="text-muted mb-0 mt-2">
                                    Upload a category image here.
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 form-check form-switch">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="status"
                                id="status"
                                value="1"
                                {{ old('status', true) ? 'checked' : '' }}
                            >
                            <label class="form-check-label fw-semibold" for="status">
                                Active Category
                            </label>
                        </div>

                    </div>

                </div>

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-lg me-2"></i>
                        Save Category
                    </button>

                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark px-4">
                        Cancel
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection
