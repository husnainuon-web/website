@extends('layouts.admin')

@section('title', 'Categories')

@section('page-title', 'Categories')

@section('content')

<div class="container-fluid px-0">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- Header --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                <div>
                    <h4 class="fw-bold mb-1">
                        <i class="bi bi-grid-3x3-gap-fill text-primary me-2"></i>
                        Product Categories
                    </h4>

                    <p class="text-muted mb-0">
                        Manage all product categories.
                    </p>
                </div>

                <a href="{{ route('admin.categories.create') }}"
                   class="btn btn-primary px-4 py-2 rounded-3">

                    <i class="bi bi-plus-lg me-2"></i>
                    Add Category

                </a>

            </div>

        </div>
    </div>


    {{-- Categories --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-header bg-white border-0 p-4">

            <h5 class="fw-bold mb-1">
                All Categories
            </h5>

            <small class="text-muted">
                Total Categories:
                <strong>{{ $categories->total() }}</strong>
            </small>

        </div>


        <div class="card-body p-0">

            @if($categories->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="px-4">#</th>

                                <th>Image</th>

                                <th>Category</th>

                                <th>Description</th>

                                <th>Status</th>

                                <th class="text-center">Actions</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($categories as $category)

                                <tr>

                                    {{-- Number --}}
                                    <td class="px-4 fw-semibold text-muted">
                                        {{ $categories->firstItem() + $loop->index }}
                                    </td>


                                    {{-- Image --}}
                                    <td>

                                        @if($category->image)

                                            <img
                                                src="{{ asset('storage/' . $category->image) }}"
                                                alt="{{ $category->name }}"
                                                class="category-image"
                                            >

                                        @else

                                            <div class="category-image-placeholder">
                                                <i class="bi bi-image"></i>
                                            </div>

                                        @endif

                                    </td>


                                    {{-- Name --}}
                                    <td>

                                        <div class="fw-bold">
                                            {{ $category->name }}
                                        </div>

                                        <small class="text-muted">
                                            ID: #{{ $category->id }}
                                        </small>

                                    </td>


                                    {{-- Description --}}
                                    <td style="max-width: 350px;">

                                        @if($category->description)

                                            <span class="text-muted">
                                                {{ Str::limit($category->description, 80) }}
                                            </span>

                                        @else

                                            <span class="text-muted fst-italic">
                                                No description
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($category->status)

                                            <span class="badge bg-success-subtle text-success status-badge">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge bg-danger-subtle text-danger status-badge">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Actions --}}
                                    <td>

                                        <div class="d-flex justify-content-center gap-2">

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                               class="btn btn-sm btn-outline-primary action-btn"
                                               title="Edit">

                                                <i class="bi bi-pencil-square"></i>

                                            </a>


                                            {{-- Delete --}}
                                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                                  method="POST"
                                                  class="delete-category-form">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger action-btn"
                                                        title="Delete">

                                                    <i class="bi bi-trash3"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                @if($categories->hasPages())

                    <div class="p-4 border-top">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <small class="text-muted">

                                Showing
                                <strong>{{ $categories->firstItem() }}</strong>
                                -
                                <strong>{{ $categories->lastItem() }}</strong>
                                of
                                <strong>{{ $categories->total() }}</strong>

                            </small>

                            {{ $categories->links() }}

                        </div>

                    </div>

                @endif


            @else

                {{-- Empty State --}}
                <div class="text-center py-5 px-4">

                    <div class="empty-icon mx-auto mb-4">

                        <i class="bi bi-grid-3x3-gap"></i>

                    </div>

                    <h5 class="fw-bold">
                        No Categories Found
                    </h5>

                    <p class="text-muted">
                        You haven't created any categories yet.
                    </p>

                    <a href="{{ route('admin.categories.create') }}"
                       class="btn btn-primary px-4 rounded-3">

                        <i class="bi bi-plus-lg me-2"></i>
                        Add First Category

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>


{{-- CSS --}}
<style>

.category-image {
    width: 58px;
    height: 58px;
    object-fit: cover;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.category-image-placeholder {
    width: 58px;
    height: 58px;
    border-radius: 12px;
    background: #f1f3f5;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #adb5bd;
    font-size: 22px;
}

.status-badge {
    padding: 8px 12px;
    border-radius: 20px;
    font-weight: 600;
}

.action-btn {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
}

.empty-icon {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: #eef4ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 38px;
    color: #0d6efd;
}

.table tbody tr {
    transition: 0.2s ease;
}

.table tbody tr:hover {
    background-color: #fafbff;
}

@media (max-width: 768px) {

    .table {
        min-width: 900px;
    }

}

</style>


{{-- Delete Confirmation --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-category-form')
        .forEach(function (form) {

            form.addEventListener('submit', function (event) {

                if (!confirm(
                    'Are you sure you want to delete this category?'
                )) {
                    event.preventDefault();
                }

            });

        });

});

</script>

@endsection