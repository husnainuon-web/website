
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Customer Dashboard') - Zain Manufacturing</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            background: #f5f7fb;
        }

        /* SIDEBAR */

        .customer-sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, #1f8f4e 0%, #167a42 100%);
            color: white;
            z-index: 1000;
            overflow-y: auto;
            box-shadow: 0 0 24px rgba(22, 122, 66, 0.18);
        }

        /* BRAND */

        .brand {
            height: 75px;
            display: flex;
            align-items: center;
            padding: 0 22px;
            border-bottom: 1px solid rgba(255,255,255,0.16);
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #ffffff 0%, #e8f9ef 100%);
            color: #167a42;
            border-radius: 12px;
            border: 1px solid rgba(22, 122, 66, 0.10);
            box-shadow: 0 8px 18px rgba(16, 185, 129, 0.18);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 21px;
            font-weight: 800;

            margin-right: 12px;
        }

        .brand h5 {
            margin: 0;
            font-weight: 700;
            font-size: 15px;
        }

        .brand small {
            color: #9ca3af;
            font-size: 10px;
        }

        /* MENU */

        .sidebar-menu {
            padding: 20px 12px;
        }

        .menu-title {
            color: #d8f5e4;
            font-size: 11px;
            font-weight: 700;
            text-transform: none;
            padding: 10px 12px;
            letter-spacing: 0.8px;
        }

        .menu-title-with-badge {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 18px;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 12px;
            line-height: 1.2;
            transition: 0.2s;
        }

        .menu-title-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 3px 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.28);
            color: #ecfdf5;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            line-height: 1;
        }

        .sidebar-menu a {
            color: #f0fdf4;
            text-decoration: none;

            display: flex;
            align-items: center;

            gap: 12px;

            padding: 12px 14px;

            border-radius: 8px;

            margin-bottom: 4px;

            font-size: 14px;

            transition: 0.2s;
        }

        .sidebar-menu a i {
            font-size: 17px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.16);
            color: #ffffff;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.08);
        }

        /* NOTIFICATION BADGE */

        .notification-badge {
            margin-left: auto;
            min-width: 21px;
            height: 21px;
            padding: 0 6px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 50px;

            background: #dc3545;
            color: white;

            font-size: 10px;
            font-weight: 700;
        }

        /* MAIN */

        .customer-main {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* NAVBAR */

        .customer-navbar {
            height: 75px;

            background: white;

            border-bottom: 1px solid #e5e7eb;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 30px;
        }

        .page-heading h4 {
            margin: 0;

            font-weight: 700;

            color: #111827;
        }

        .page-heading small {
            color: #6b7280;
        }

        /* NAVBAR NOTIFICATION */

        .navbar-notification {
            position: relative;
            margin-right: 18px;
        }

        .navbar-notification a {
            width: 40px;
            height: 40px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #374151;
            background: #f3f4f6;

            text-decoration: none;

            transition: 0.2s;
        }

        .navbar-notification a:hover {
            background: #e5e7eb;
            color: #111827;
        }

        .navbar-notification i {
            font-size: 19px;
        }

        .navbar-notification .count {
            position: absolute;

            top: -4px;
            right: -4px;

            min-width: 19px;
            height: 19px;

            padding: 0 5px;

            background: #dc3545;
            color: white;

            border-radius: 50px;

            font-size: 9px;
            font-weight: 700;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 2px solid white;
        }

        /* PROFILE */

        .customer-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .customer-avatar {
            width: 40px;
            height: 40px;

            border-radius: 50%;

            background: #111827;

            color: white;

            display: flex;

            align-items: center;

            justify-content: center;

            font-weight: 700;
        }

        .customer-info strong {
            display: block;

            font-size: 13px;
        }

        .customer-info small {
            color: #6b7280;

            font-size: 11px;
        }

        /* CONTENT */

        .customer-content {
            padding: 30px;
        }

        /* MOBILE */

        @media (max-width: 768px) {

            .customer-sidebar {
                position: relative;

                width: 100%;

                height: auto;
            }

            .customer-main {
                margin-left: 0;
            }

            .customer-navbar {
                padding: 0 15px;
            }

            .customer-content {
                padding: 20px 15px;
            }

            .customer-info {
                display: none;
            }

        }

    </style>

</head>


<body>


<!-- ================================================= -->
<!-- SIDEBAR -->
<!-- ================================================= -->

<aside class="customer-sidebar">


    <!-- BRAND -->

    <div class="brand">

        <div class="brand-logo">
            S
        </div>

        <div>

            <h5>
                SPITALSPORTS
            </h5>

            <small>
                CUSTOMER PANEL
            </small>

        </div>

    </div>


    <!-- MENU -->

    <div class="sidebar-menu">


        <!-- MAIN -->

        <div class="menu-title">
            Main
        </div>


        <!-- DASHBOARD -->

        <a
            href="{{ route('customer.dashboard') }}"
            class="{{ request()->routeIs('customer.dashboard') ? 'active' : '' }}"
        >

            <i class="bi bi-house-door"></i>

            Dashboard

        </a>


        <!-- PRODUCTS -->

        <a
            href="{{ route('customer.products.index') }}"
            class="{{ request()->routeIs('customer.products.*') ? 'active' : '' }}"
        >

            <i class="bi bi-box-seam"></i>

            Products

        </a>


        <!-- WISHLIST -->

        <a
            href="{{ route('customer.wishlist.index') }}"
            class="{{ request()->routeIs('customer.wishlist.*') ? 'active' : '' }}"
        >

            <i class="bi bi-heart"></i>

            Wishlist

        </a>


        <!-- CART -->

        <a
            href="{{ route('customer.cart.index') }}"
            class="{{ request()->routeIs('customer.cart.*') ? 'active' : '' }}"
        >

            <i class="bi bi-cart3"></i>

            Cart

        </a>


        <!-- MY ACCOUNT -->

        <div class="menu-title mt-3">
            My Account
        </div>


        <!-- MY ORDERS -->

        <a
            href="{{ route('customer.orders.index') }}"
            class="{{ request()->routeIs('customer.orders.*') ? 'active' : '' }}"
        >

            <i class="bi bi-bag"></i>

            My Orders

        </a>


        <!-- MY QUOTATIONS -->

        <a
            href="{{ route('customer.quotations.index') }}"
            class="{{ request()->routeIs('customer.quotations.*') ? 'active' : '' }}"
        >

            <i class="bi bi-file-earmark-text"></i>

            My Quotations

        </a>


        <!-- NOTIFICATIONS -->

        <a
            href="{{ route('customer.notifications.index') }}"
            class="{{ request()->routeIs('customer.notifications.*') ? 'active' : '' }}"
        >

            <i class="bi bi-bell"></i>

            Notifications

            @php
                $unreadNotificationsCount = Auth::user()
                    ->unreadNotifications
                    ->count();
            @endphp

            @if($unreadNotificationsCount > 0)

                <span class="notification-badge">
                    {{ $unreadNotificationsCount > 99 ? '99+' : $unreadNotificationsCount }}
                </span>

            @endif

        </a>


        <!-- PROFILE -->

        <a
            href="{{ route('customer.profile.index') }}"
            class="{{ request()->routeIs('customer.profile.*') ? 'active' : '' }}"
        >

            <i class="bi bi-person"></i>

            Profile

        </a>


        <!-- OTHER -->

        <div class="menu-title mt-3">
            Other
        </div>


        <!-- RECOMMENDATIONS -->

        <a
            href="{{ route('customer.recommendations.index') }}"
            class="{{ request()->routeIs('customer.recommendations.*') ? 'active' : '' }}"
        >

            <i class="bi bi-stars"></i>

            Recommended For You

        </a>


        
<!-- SUPPORT -->

<a
    href="{{ route('customer.support.index') }}"
    class="{{ request()->routeIs('customer.support.*') ? 'active' : '' }}"
>

    <i class="bi bi-headset"></i>

    Support

</a>




        <!-- LOGOUT -->

        <div class="mt-4">

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="btn btn-link text-decoration-none w-100 text-start"
                    style="color:#d1d5db;"
                >

                    <i class="bi bi-box-arrow-right me-2"></i>

                    Logout

                </button>

            </form>

        </div>


    </div>

</aside>


<!-- ================================================= -->
<!-- MAIN -->
<!-- ================================================= -->

<main class="customer-main">


    <!-- NAVBAR -->

    <nav class="customer-navbar">


        <div class="page-heading">

            <h4>

                @yield('page-title', 'Dashboard')

            </h4>

            <small>

                Welcome to Zain Manufacturing

            </small>

        </div>


        <!-- RIGHT SIDE -->

        <div class="d-flex align-items-center">


            <!-- NOTIFICATION ICON -->

            <div class="navbar-notification">

                <a
                    href="{{ route('customer.notifications.index') }}"
                    title="Notifications"
                >

                    <i class="bi bi-bell"></i>

                    @php
                        $navbarUnreadCount = Auth::user()
                            ->unreadNotifications
                            ->count();
                    @endphp

                    @if($navbarUnreadCount > 0)

                        <span class="count">
                            {{ $navbarUnreadCount > 99 ? '99+' : $navbarUnreadCount }}
                        </span>

                    @endif

                </a>

            </div>


            <!-- CUSTOMER PROFILE -->

            <div class="customer-profile">


                <div class="customer-info text-end">

                    <strong>
                        {{ Auth::user()->name }}
                    </strong>

                    <small>
                        Customer
                    </small>

                </div>


                <div class="customer-avatar">

                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                </div>


            </div>


        </div>


    </nav>


    <!-- PAGE CONTENT -->

    <section class="customer-content">

        @yield('content')

    </section>


</main>


<!-- Bootstrap JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>
