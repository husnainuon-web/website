@extends('layouts.admin')

@section('title', 'Edit Category')

@section('page-title', 'Edit Category')

@section('content')

<div class="container-fluid px-0">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                <i class="bi bi-pencil-square me-2"></i>
                Edit Category
            </h4>

            <p class="text-muted mb-0">
                Update the category details below.
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

            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <div class="col-lg-8">

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Category Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control"
                                value="{{ old('name', $category->name) }}"
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
                            >{{ old('description', $category->description) }}</textarea>
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

                        @if($category->image)
                            <div class="card bg-light border-0 rounded-4 mb-3">
                                <div class="card-body text-center p-3">
                                    <img
                                        src="{{ asset('storage/' . $category->image) }}"
                                        alt="{{ $category->name }}"
                                        class="img-fluid rounded-3"
                                        style="max-height: 180px; object-fit: cover;"
                                    >
                                </div>
                            </div>
                        @endif

                        <div class="mt-4 form-check form-switch">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="status"
                                id="status"
                                value="1"
                                {{ old('status', $category->status) ? 'checked' : '' }}
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
                        Update Category
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
