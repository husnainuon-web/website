
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
            transform: translateX(-100%);
            transition: transform 0.25s ease;
        }

        .customer-sidebar.is-open {
            transform: translateX(0);
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            z-index: 999;
            background: rgba(15, 23, 42, 0.45);
        }

        .sidebar-overlay[hidden] {
            display: none;
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
            margin-left: 0;
            min-height: 100vh;
        }

        /* NAVBAR */

        .customer-navbar {
            background: white;

            border-bottom: 1px solid #e5e7eb;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 16px;
            min-height: 75px;
            padding: 12px 30px;
        }

        .menu-toggle {
            display: inline-flex;
            width: 42px;
            height: 42px;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            border: 0;
            border-radius: 8px;
            background: #f3f4f6;
            color: #1f2937;
            font-size: 21px;
        }

        .page-heading h4 {
            margin: 0;

            font-weight: 700;

            color: #111827;
        }

        .page-heading small {
            color: #6b7280;
        }

        .navbar-account-actions {
            display: flex;
            align-items: center;
            gap: 8px;
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

        .customer-whatsapp-button {
            position: fixed;
            right: 24px;
            bottom: 24px;
            z-index: 998;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 12px 18px;
            border-radius: 999px;
            background: #25d366;
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .customer-whatsapp-button:hover {
            background: #1da851;
            color: #fff;
            transform: translateY(-2px);
        }

        .customer-whatsapp-button:focus-visible {
            outline: 3px solid #14532d;
            outline-offset: 3px;
        }

        @media (max-width: 768px) {
            .customer-navbar {
                padding: 0 15px;
                flex-wrap: wrap;
            }

            .customer-content {
                padding: 20px 15px;
            }

            .customer-info {
                display: none;
            }

            .navbar-account-actions {
                margin-left: auto;
            }
        }

    </style>

</head>


<body>

<div class="sidebar-overlay" id="sidebar-overlay" hidden></div>

<!-- ================================================= -->
<!-- SIDEBAR -->
<!-- ================================================= -->

<aside class="customer-sidebar" id="customer-sidebar">


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


        <!-- HOME -->

        <a
            href="{{ url('/') }}"
            class="{{ request()->is('/') ? 'active' : '' }}"
        >

            <i class="bi bi-house-door"></i>

            Home

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


        <div class="menu-title mt-3">
            Account
        </div>

        @guest
            <a href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Sign In</a>
            <a href="{{ route('register') }}"><i class="bi bi-person-plus"></i> Register</a>
        @else
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
                    Sign Out
                </button>
            </form>
        @endguest

    </div>

</aside>


<!-- ================================================= -->
<!-- MAIN -->
<!-- ================================================= -->

<main class="customer-main">


    <!-- NAVBAR -->

    <nav class="customer-navbar">


        <button type="button" class="menu-toggle" id="menu-toggle" aria-label="Open menu" aria-controls="customer-sidebar" aria-expanded="false">
            <i class="bi bi-list" aria-hidden="true"></i>
        </button>

        <div class="page-heading me-auto">

            <h4>

                @yield('page-title', 'Dashboard')

            </h4>

            <small>

                Welcome to Zain Manufacturing

            </small>

        </div>

        <div class="navbar-account-actions">
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-success btn-sm">Register</a>
            @else
                <span class="small text-muted d-none d-sm-inline">Hi, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm">Sign Out</button>
                </form>
            @endguest
        </div>

    </nav>


    <!-- PAGE CONTENT -->

    <section class="customer-content">

        @yield('content')

    </section>


</main>

<a
    href="https://wa.me/923084557950?text=Assalam-o-Alaikum%2C%20I%20need%20help%20with%20Zain%20Manufacturing."
    class="customer-whatsapp-button"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Contact Zain Manufacturing on WhatsApp"
>
    <i class="bi bi-whatsapp" aria-hidden="true"></i>
    <span>WhatsApp</span>
</a>

<!-- Bootstrap JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

<script>
    const menuButton = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('customer-sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    function setMenuOpen(open) {
        sidebar.classList.toggle('is-open', open);
        overlay.hidden = !open;
        menuButton.setAttribute('aria-expanded', String(open));
    }

    menuButton.addEventListener('click', () => {
        setMenuOpen(!sidebar.classList.contains('is-open'));
    });
    overlay.addEventListener('click', () => setMenuOpen(false));
    sidebar.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setMenuOpen(false));
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') setMenuOpen(false);
    });
</script>

</body>

</html>
