<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>


<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>
    @yield('title', 'Spital Sport')
</title>


{{-- Bootstrap --}}
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>

{{-- Bootstrap Icons --}}
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>


<style>

    /* =====================================================
       GLOBAL
    ===================================================== */

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background: #f4f7f5;
        color: #1f2937;
        font-family: 'Segoe UI', Arial, sans-serif;
    }


    /* =====================================================
       APP
    ===================================================== */

    .app-shell {
        display: flex;
        min-height: 100vh;
    }


    /* =====================================================
       SIDEBAR
    ===================================================== */

    .sidebar {
        width: 270px;
        min-height: 100vh;

        background:
            linear-gradient(
                180deg,
                #071a12 0%,
                #0b2117 50%,
                #071a12 100%
            );

        color: #ffffff;

        padding: 24px 18px;

        flex-shrink: 0;

        box-shadow:
            8px 0 30px
            rgba(0, 0, 0, 0.08);
    }


    /* =====================================================
       SPOTLITE BRAND
    ===================================================== */

    .brand {
        display: flex;

        align-items: center;

        gap: 13px;

        padding: 8px 10px 22px;

        border-bottom:
            1px solid
            rgba(255,255,255,0.10);

        margin-bottom: 22px;
    }


    .brand-mark {
        width: 48px;
        height: 48px;

        border-radius: 14px;

        background:
            linear-gradient(
                135deg,
                #22c55e,
                #16a34a
            );

        color: #ffffff;

        font-weight: 900;

        font-size: 1.35rem;

        display: flex;

        align-items: center;

        justify-content: center;

        box-shadow:
            0 8px 22px
            rgba(34,197,94,0.30);
    }


    .brand-info {
        display: flex;

        flex-direction: column;

        line-height: 1.1;
    }


    .brand-text {
        font-size: 1.12rem;

        font-weight: 900;

        letter-spacing: 0.12em;

        color: #4ade80;
    }


    .brand-tagline {
        margin-top: 6px;

        font-size: 9px;

        font-weight: 600;

        letter-spacing: 0.08em;

        text-transform: uppercase;

        color: #9ca3af;
    }


    /* =====================================================
       NAVIGATION
    ===================================================== */

    .nav-title {
        font-size: 10px;

        font-weight: 700;

        letter-spacing: 0.12em;

        text-transform: uppercase;

        color: #6ee7a0;

        padding: 0 12px 10px;

        margin-top: 8px;
    }


    .nav-links {
        display: flex;

        flex-direction: column;

        gap: 6px;
    }


    .nav-link {
        display: flex;

        align-items: center;

        gap: 12px;

        padding: 12px 14px;

        border-radius: 11px;

        color: #cbd5d0;

        text-decoration: none;

        font-size: 14px;

        font-weight: 600;

        transition:
            all 0.2s ease;
    }


    .nav-link i {
        font-size: 18px;

        width: 22px;

        text-align: center;

        color: #94a3a0;

        transition:
            all 0.2s ease;
    }


    .nav-link:hover {
        background:
            rgba(34,197,94,0.10);

        color: #ffffff;

        transform:
            translateX(3px);
    }


    .nav-link:hover i {
        color: #4ade80;
    }


    .nav-link.active {
        background:
            linear-gradient(
                90deg,
                rgba(34,197,94,0.20),
                rgba(34,197,94,0.08)
            );

        color: #ffffff;

        box-shadow:
            inset 3px 0 0 #22c55e;
    }


    .nav-link.active i {
        color: #4ade80;
    }


    /* =====================================================
       MAIN CONTENT
    ===================================================== */

    .main-content {
        flex: 1;

        display: flex;

        flex-direction: column;

        min-width: 0;
    }


    /* =====================================================
       TOPBAR
    ===================================================== */

    .topbar {
        background: #ffffff;

        border-bottom:
            1px solid #e5ebe7;

        padding: 18px 30px;

        display: flex;

        justify-content: space-between;

        align-items: center;

        box-shadow:
            0 3px 15px
            rgba(15,23,42,0.03);
    }


    .top-label {
        margin: 0;

        font-size: 11px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: 0.10em;

        color: #16a34a;
    }


    .title {
        margin: 4px 0 0;

        font-size: 1.8rem;

        font-weight: 800;

        color: #111827;
    }


    /* =====================================================
       TOP ACTIONS
    ===================================================== */

    .top-actions {
        display: flex;

        align-items: center;

        gap: 14px;
    }


    .welcome-text {
        font-weight: 600;

        color: #374151;

        padding: 8px 12px;

        background: #f0fdf4;

        border-radius: 9px;
    }


    .logout-btn {
        border:
            1px solid #d1d5db;

        background: #ffffff;

        border-radius: 9px;

        padding: 8px 15px;

        color: #374151;

        font-weight: 600;

        cursor: pointer;

        transition:
            all 0.2s ease;
    }


    .logout-btn:hover {
        background: #dc2626;

        color: #ffffff;

        border-color: #dc2626;

        transform:
            translateY(-1px);
    }


    /* =====================================================
       CONTENT
    ===================================================== */

    .content-body {
        padding: 30px;
    }


    /* =====================================================
       CARDS
    ===================================================== */

    .card {
        border:
            1px solid #e5ebe7;

        border-radius: 18px;

        background: #ffffff;

        box-shadow:
            0 10px 30px
            rgba(15,23,42,0.045);
    }


    .card-header {
        border-bottom:
            1px solid #edf1ee;
    }


    /* =====================================================
       FORMS
    ===================================================== */

    .form-control,
    .form-select,
    .form-check-input {
        border-radius: 10px;

        min-height: 46px;
    }


    .form-control:focus,
    .form-select:focus,
    .form-check-input:focus {
        border-color: #22c55e;

        box-shadow:
            0 0 0 0.25rem
            rgba(34,197,94,0.12);
    }


    /* =====================================================
       BUTTONS
    ===================================================== */

    .btn-primary {
        background:
            linear-gradient(
                135deg,
                #16a34a,
                #15803d
            );

        border-color: #16a34a;

        border-radius: 9px;

        font-weight: 600;
    }


    .btn-primary:hover {
        background:
            linear-gradient(
                135deg,
                #15803d,
                #166534
            );

        border-color: #15803d;
    }


    /* =====================================================
       BADGES
    ===================================================== */

    .badge.bg-primary {
        background-color: #16a34a !important;
    }


    /* =====================================================
       ALERTS
    ===================================================== */

    .alert {
        border-radius: 12px;

        margin-bottom: 24px;
    }


    /* =====================================================
       TABLE
    ===================================================== */

    .table {
        vertical-align: middle;
    }


    .table thead th {
        font-size: 12px;

        text-transform: uppercase;

        letter-spacing: 0.04em;

        color: #6b7280;
    }


    /* =====================================================
       MOBILE
    ===================================================== */

    @media (max-width: 991px) {

        .app-shell {
            flex-direction: column;
        }


        .sidebar {
            width: 100%;

            min-height: auto;

            padding: 18px;
        }


        .nav-links {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);
        }


        .topbar {
            flex-direction: column;

            align-items: flex-start;

            gap: 12px;
        }


        .content-body {
            padding: 20px;
        }

    }


    @media (max-width: 576px) {

        .nav-links {
            grid-template-columns: 1fr;
        }


        .top-actions {
            width: 100%;

            justify-content: space-between;
        }


        .brand {
            padding-bottom: 16px;
        }

    }

</style>

@yield('styles')


</head>

<body>

<div class="app-shell">


{{-- =====================================================
     SIDEBAR
====================================================== --}}

<aside class="sidebar">


    {{-- SPOTLITE BRAND --}}

    <div class="brand">

        <div class="brand-mark">
            S
        </div>


        <div class="brand-info">

            <div class="brand-text">
                Spital Sport
            </div>

            <div class="brand-tagline">
                Admin Panel
            </div>

        </div>

    </div>


    {{-- NAVIGATION --}}

    <div class="nav-title">
        Navigation
    </div>


    <nav class="nav-links">


        {{-- DASHBOARD --}}

        <a
            href="{{ route('admin.dashboard') }}"
            class="nav-link
            {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
        >

            <i class="bi bi-speedometer2"></i>

            <span>
                Dashboard
            </span>

        </a>


        {{-- CATEGORIES --}}

        <a
            href="{{ route('admin.categories.index') }}"
            class="nav-link
            {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
        >

            <i class="bi bi-grid-3x3-gap"></i>

            <span>
                Categories
            </span>

        </a>


        {{-- PRODUCTS --}}

        <a
            href="{{ route('admin.products.index') }}"
            class="nav-link
            {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
        >

            <i class="bi bi-box-seam"></i>

            <span>
                Products
            </span>

        </a>


        {{-- CUSTOMERS --}}

        <a
            href="{{ route('admin.customers.index') }}"
            class="nav-link
            {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}"
        >

            <i class="bi bi-people"></i>

            <span>
                Customers
            </span>

        </a>


        {{-- ORDERS --}}

        <a
            href="{{ route('admin.orders.index') }}"
            class="nav-link
            {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"
        >

            <i class="bi bi-cart3"></i>

            <span>
                Orders
            </span>

        </a>


        {{-- QUOTATIONS --}}

        <a
            href="{{ route('admin.quotations.index') }}"
            class="nav-link
            {{ request()->routeIs('admin.quotations.*') ? 'active' : '' }}"
        >

            <i class="bi bi-file-earmark-text"></i>

            <span>
                Quotations
            </span>

        </a>


        {{-- SUPPORT --}}

        <a
            href="{{ route('admin.support.index') }}"
            class="nav-link
            {{ request()->routeIs('admin.support.*') ? 'active' : '' }}"
        >

            <i class="bi bi-headset"></i>

            <span>
                Support
            </span>

        </a>


        {{-- REPORTS --}}

        <a
            href="{{ route('admin.reports.index') }}"
            class="nav-link
            {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"
        >

            <i class="bi bi-bar-chart-line"></i>

            <span>
                Reports
            </span>

        </a>


        {{-- AI RECOMMENDATIONS --}}

        <a
            href="{{ route('admin.recommendations.index') }}"
            class="nav-link
            {{ request()->routeIs('admin.recommendations.*') ? 'active' : '' }}"
        >

            <i class="bi bi-stars"></i>

            <span>
                AI Recommendations
            </span>

        </a>


    </nav>

</aside>


{{-- =====================================================
     MAIN CONTENT
====================================================== --}}

<main class="main-content">


    {{-- TOPBAR --}}

    <header class="topbar">


        <div>

            <p class="top-label">
                Spital Sport Admin Panel
            </p>


            <h1 class="title">
                @yield('page-title', 'Dashboard')
            </h1>

        </div>


        {{-- TOP ACTIONS --}}

        <div class="top-actions">


            <span class="welcome-text">

                <i class="bi bi-person-circle me-1"></i>

                {{ Auth::check() ? Auth::user()->name : 'Admin' }}

            </span>


            {{-- LOGOUT --}}

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-btn"
                >

                    <i class="bi bi-box-arrow-right me-1"></i>

                    Logout

                </button>

            </form>


        </div>

    </header>


    {{-- =================================================
         PAGE CONTENT
    ================================================== --}}

    <div class="content-body">


        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>

            </div>

        @endif


        {{-- ERROR MESSAGE --}}

        @if(session('error'))

            <div
                class="alert alert-danger alert-dismissible fade show"
                role="alert"
            >

                <i class="bi bi-exclamation-triangle me-2"></i>

                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>

            </div>

        @endif


        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div
                class="alert alert-danger alert-dismissible fade show"
                role="alert"
            >

                <strong>
                    Please fix the following errors:
                </strong>


                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>

            </div>

        @endif


        {{-- PAGE CONTENT --}}

        @yield('content')


    </div>

</main>


</div>

{{-- Bootstrap JS --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

@yield('scripts')

</body>

</html>
