
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Zain Manufacturing') }}
    </title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Font -->
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Figtree', Arial, sans-serif;
            background: #f5f7f6;
            color: #1f2937;
        }

        /* =========================
           NAVBAR
        ========================= */

        .zain-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            min-height: 70px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .brand {
            color: #39B54A;
            font-size: 25px;
            font-weight: 800;
            text-decoration: none;
            letter-spacing: .5px;
        }

        .brand:hover {
            color: #2E963D;
        }

        .nav-link-custom {
            color: #374151;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 7px;
            transition: all .2s ease;
        }

        .nav-link-custom:hover {
            color: #39B54A;
            background: #f0faf2;
        }

        /* =========================
           ADMIN INFORMATION
        ========================= */

        .admin-info {
            text-align: right;
        }

        .admin-name {
            font-weight: 600;
            color: #17251d;
        }

        .admin-email {
            font-size: 12px;
            color: #6b7280;
        }

        /* =========================
           LOGOUT
        ========================= */

        .logout-btn {
            border: none;
            background: transparent;
            color: #dc3545;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 7px;
            cursor: pointer;
        }

        .logout-btn:hover {
            color: #b02a37;
            background: #fff5f5;
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .main-content {
            min-height: calc(100vh - 70px);
            padding: 25px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

            .main-content {
                padding: 15px;
            }

            .brand {
                font-size: 21px;
            }

            .admin-info {
                display: none;
            }

            .nav-link-custom {
                padding: 7px 8px;
                font-size: 14px;
            }

        }

    </style>

</head>


<body>


    <!-- =================================
         ZAIN MANUFACTURING NAVBAR
    ================================== -->

    <nav class="zain-navbar">

        <div class="container-fluid px-4">

            <div
                class="d-flex align-items-center justify-content-between"
                style="min-height:70px;"
            >


                <!-- BRAND -->

                <a
                    href="{{ route('dashboard') }}"
                    class="brand"
                >
                    ZAIN MANUFACTURING
                </a>


                <!-- RIGHT SIDE -->

                <div class="d-flex align-items-center gap-3">

                    @auth


                        <!-- DASHBOARD -->

                        <a
                            href="{{ route('dashboard') }}"
                            class="nav-link-custom"
                        >
                            Dashboard
                        </a>


                        <!-- ADMIN INFORMATION -->

                        <div class="admin-info">

                            <div class="admin-name">
                                {{ Auth::user()->name }}
                            </div>

                            <div class="admin-email">
                                {{ Auth::user()->email }}
                            </div>

                        </div>


                        <!-- LOGOUT -->

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                            class="m-0"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="logout-btn"
                            >
                                Log Out
                            </button>

                        </form>


                    @endauth

                </div>

            </div>

        </div>

    </nav>


    <!-- =================================
         PAGE CONTENT
    ================================== -->

    <main class="main-content">

        @yield('content')

    </main>


    <!-- Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>

