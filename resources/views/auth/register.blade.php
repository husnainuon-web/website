
<x-guest-layout>

    <style>
        body {
            background: #f3f7f4;
        }

        .register-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 25px;
        }

        .register-container {
            width: 100%;
            max-width: 1100px;
            min-height: 650px;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 20px 60px rgba(20, 83, 45, 0.14);
            border: 1px solid #e1ebe4;
        }

        /* LEFT SIDE */

        .register-left {
            width: 52%;
            padding: 55px 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-content {
            width: 100%;
            max-width: 430px;
        }

        .logo {
            width: 58px;
            height: 58px;
            background: linear-gradient(135deg, #22c55e, #15803d);
            color: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            font-weight: 900;
            margin-bottom: 12px;
            box-shadow: 0 8px 20px rgba(22, 163, 74, 0.20);
        }

        .brand {
            color: #15803d;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: 3px;
            margin-bottom: 28px;
        }

        .title {
            font-size: 30px;
            font-weight: 800;
            color: #17251d;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 27px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        .form-label {
            display: block;
            color: #26352d;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .form-control {
            width: 100%;
            height: 46px;
            padding: 10px 13px;
            border: 1px solid #d4ddd7;
            border-radius: 9px;
            outline: none;
            font-size: 14px;
            background: #ffffff;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.10);
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-control {
            padding-right: 65px;
        }

        .show-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #15803d;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
        }

        .register-button {
            width: 100%;
            height: 47px;
            border: none;
            border-radius: 9px;
            background: #15803d;
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 4px;
            transition: 0.2s;
        }

        .register-button:hover {
            background: #166534;
        }

        .login-text {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin-top: 20px;
        }

        .login-text a {
            color: #15803d;
            font-weight: 700;
        }

        .footer {
            text-align: center;
            color: #9ca3af;
            font-size: 11px;
            margin-top: 18px;
        }

        /* RIGHT SIDE */

        .register-right {
            width: 48%;
            background: linear-gradient(
                145deg,
                #14532d,
                #15803d,
                #22c55e
            );
            color: white;
            padding: 60px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .register-right::before {
            content: "";
            position: absolute;
            width: 350px;
            height: 350px;
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 50%;
            right: -150px;
            top: -120px;
        }

        .register-right::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 50%;
            left: -150px;
            bottom: -130px;
        }

        .right-content {
            position: relative;
            z-index: 2;
        }

        .small-title {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #bbf7d0;
            margin-bottom: 15px;
        }

        .right-heading {
            font-size: 38px;
            line-height: 1.15;
            font-weight: 900;
            margin-bottom: 18px;
        }

        .right-description {
            font-size: 15px;
            line-height: 1.8;
            color: #ecfdf5;
            margin-bottom: 30px;
            max-width: 430px;
        }

        .service-item {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 17px;
        }

        .service-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: bold;
        }

        .service-text strong {
            display: block;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .service-text span {
            color: #d1fae5;
            font-size: 12px;
        }

        .trust-box {
            margin-top: 28px;
            padding: 17px;
            border-radius: 12px;
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.15);
        }

        .trust-title {
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .trust-text {
            color: #dcfce7;
            font-size: 12px;
            line-height: 1.6;
        }

        /* MOBILE */

        @media (max-width: 850px) {

            .register-container {
                max-width: 520px;
            }

            .register-left {
                width: 100%;
                padding: 45px 35px;
            }

            .register-right {
                display: none;
            }
        }

        @media (max-width: 500px) {

            .register-page {
                padding: 20px 12px;
            }

            .register-left {
                padding: 35px 22px;
            }

            .title {
                font-size: 27px;
            }
        }
    </style>


    <div class="register-page">

        <div class="register-container">

            <!-- LEFT REGISTER FORM -->

            <div class="register-left">

                <div class="register-content">

                    <div class="logo">
                        S
                    </div>

                    <div class="brand">
                        SPOTLITE
                    </div>

                    <div class="title">
                        Create Account
                    </div>

                    <div class="subtitle">
                        Create your SPOTLITE account and start
                        exploring quality manufacturing products
                        and services.
                    </div>


                    @if ($errors->any())
                        <div style="
                            background:#fef2f2;
                            color:#b91c1c;
                            padding:10px 13px;
                            border-radius:8px;
                            font-size:13px;
                            margin-bottom:18px;
                        ">
                            Please correct the errors below.
                        </div>
                    @endif


                    <form method="POST" action="{{ route('register') }}">

                        @csrf


                        <!-- NAME -->

                        <div class="form-group">

                            <label for="name" class="form-label">
                                Full Name
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control"
                                placeholder="Enter your full name"
                                required
                                autofocus
                                autocomplete="name"
                            >

                            @error('name')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- EMAIL -->

                        <div class="form-group">

                            <label for="email" class="form-label">
                                Email Address
                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control"
                                placeholder="Enter your email address"
                                required
                                autocomplete="username"
                            >

                            @error('email')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- PASSWORD -->

                        <div class="form-group">

                            <label for="password" class="form-label">
                                Password
                            </label>

                            <div class="password-wrapper">

                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Create a password"
                                    required
                                    autocomplete="new-password"
                                >

                                <button
                                    type="button"
                                    class="show-password"
                                    onclick="togglePassword('password', this)"
                                >
                                    Show
                                </button>

                            </div>

                            @error('password')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- CONFIRM PASSWORD -->

                        <div class="form-group">

                            <label
                                for="password_confirmation"
                                class="form-label"
                            >
                                Confirm Password
                            </label>

                            <div class="password-wrapper">

                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Confirm your password"
                                    required
                                    autocomplete="new-password"
                                >

                                <button
                                    type="button"
                                    class="show-password"
                                    onclick="togglePassword(
                                        'password_confirmation',
                                        this
                                    )"
                                >
                                    Show
                                </button>

                            </div>

                            @error('password_confirmation')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- REGISTER -->

                        <button
                            type="submit"
                            class="register-button"
                        >
                            Register
                        </button>


                        <div class="login-text">

                            Already have an account?

                            <a href="{{ route('login') }}">
                                Login here
                            </a>

                        </div>

                    </form>


                    <div class="footer">
                        © {{ date('Y') }} SPOTLITE · Manufacturing Solutions
                    </div>

                </div>

            </div>


            <!-- RIGHT INFORMATION SIDE -->

            <div class="register-right">

                <div class="right-content">

                    <div class="small-title">
                        SPOTLITE Manufacturing
                    </div>

                    <div class="right-heading">
                        Quality Manufacturing.<br>
                        Trusted Service.
                    </div>

                    <div class="right-description">
                        SPOTLITE provides reliable manufacturing
                        solutions and quality products designed to
                        meet the needs of modern businesses.
                    </div>


                    <!-- SERVICE 1 -->

                    <div class="service-item">

                        <div class="service-icon">
                            ✓
                        </div>

                        <div class="service-text">

                            <strong>
                                Quality Products
                            </strong>

                            <span>
                                Reliable products built with quality
                                standards.
                            </span>

                        </div>

                    </div>


                    <!-- SERVICE 2 -->

                    <div class="service-item">

                        <div class="service-icon">
                            ✓
                        </div>

                        <div class="service-text">

                            <strong>
                                Trusted Service
                            </strong>

                            <span>
                                Professional support for our customers.
                            </span>

                        </div>

                    </div>


                    <!-- SERVICE 3 -->

                    <div class="service-item">

                        <div class="service-icon">
                            ✓
                        </div>

                        <div class="service-text">

                            <strong>
                                Customer Support
                            </strong>

                            <span>
                                We're here to assist you whenever you need us.
                            </span>

                        </div>

                    </div>


                    <!-- SERVICE 4 -->

                    <div class="service-item">

                        <div class="service-icon">
                            ✓
                        </div>

                        <div class="service-text">

                            <strong>
                                24/7 Assistance
                            </strong>

                            <span>
                                Dedicated support for a smooth experience.
                            </span>

                        </div>

                    </div>


                    <!-- TRUST BOX -->

                    <div class="trust-box">

                        <div class="trust-title">
                            Why choose SPOTLITE?
                        </div>

                        <div class="trust-text">
                            We focus on quality, reliability and
                            customer satisfaction to provide a
                            dependable manufacturing experience.
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>

        function togglePassword(inputId, button) {

            const input = document.getElementById(inputId);

            if (input.type === "password") {

                input.type = "text";
                button.innerText = "Hide";

            } else {

                input.type = "password";
                button.innerText = "Show";

            }
        }

    </script>

</x-guest-layout>

