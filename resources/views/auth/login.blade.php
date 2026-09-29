
<x-guest-layout>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4faf5;
            color: #17251d;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .login-container {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: 0 20px 60px rgba(45, 100, 55, 0.12);
        }

        /* =========================
           LEFT SIDE
        ========================= */

        .login-left {
            padding: 55px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 45px;
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: #39B54A;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            font-weight: bold;
        }

        .brand-name {
            font-size: 25px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #2f713b;
        }

        .login-title {
            font-size: 36px;
            margin: 0 0 10px;
            color: #26352c;
        }

        .login-subtitle {
            color: #7b887f;
            margin-bottom: 32px;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #425149;
        }

        .input-wrapper {
            position: relative;
        }

        .form-input {
            width: 100%;
            height: 52px;
            border: 1px solid #d6e5d9;
            border-radius: 11px;
            padding: 0 15px;
            font-size: 15px;
            outline: none;
            background: #fcfefd;
            transition: 0.2s;
            color: #26352c;
        }

        .form-input::placeholder {
            color: #a0aaa4;
        }

        .form-input:focus {
            border-color: #39B54A;
            box-shadow: 0 0 0 3px rgba(57, 181, 74, 0.12);
            background: #ffffff;
        }

        .password-input {
            padding-right: 75px;
        }

        .show-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #39B54A;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .show-password:hover {
            color: #2E963D;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 5px 0 25px;
            font-size: 13px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #758078;
            cursor: pointer;
        }

        .remember input {
            accent-color: #39B54A;
            cursor: pointer;
        }

        .forgot-link {
            color: #39B54A;
            font-weight: 600;
            text-decoration: none;
        }

        .forgot-link:hover {
            color: #2E963D;
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 11px;
            background: #39B54A;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-button:hover {
            background: #2E963D;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(57, 181, 74, 0.20);
        }

        .register-text {
            text-align: center;
            margin-top: 25px;
            color: #7b887f;
            font-size: 14px;
        }

        .register-link {
            color: #39B54A;
            font-weight: 700;
            text-decoration: none;
        }

        .register-link:hover {
            color: #2E963D;
            text-decoration: underline;
        }

        .error-message {
            color: #c0392b;
            font-size: 13px;
            margin-top: 7px;
        }

        /* =========================
           RIGHT SIDE
        ========================= */

        .login-right {
            background: linear-gradient(
                145deg,
                #4CCB5F,
                #39B54A
            );

            color: #ffffff;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-right::before {
            content: "";
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.10);
            top: -120px;
            right: -120px;
        }

        .login-right::after {
            content: "";
            position: absolute;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.07);
            bottom: -100px;
            left: -90px;
        }

        .right-content {
            position: relative;
            z-index: 2;
        }

        .right-logo {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.22);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            font-weight: bold;
            margin-bottom: 28px;
            color: #ffffff;
        }

        .right-title {
            font-size: 38px;
            margin: 0 0 12px;
            letter-spacing: 1px;
            color: #ffffff;
        }

        .right-heading {
            font-size: 22px;
            margin: 0 0 15px;
            font-weight: 600;
            color: #ffffff;
        }

        .right-description {
            color: rgba(255, 255, 255, 0.88);
            line-height: 1.7;
            font-size: 14px;
            max-width: 400px;
            margin-bottom: 30px;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.95);
        }

        .feature-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.16);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .trust-box {
            margin-top: 35px;
            padding: 16px 18px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.14);
            font-size: 13px;
            color: rgba(255, 255, 255, 0.90);
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 850px) {

            .login-container {
                grid-template-columns: 1fr;
                max-width: 600px;
            }

            .login-right {
                display: none;
            }

            .login-left {
                padding: 45px 35px;
            }
        }

        @media (max-width: 500px) {

            .login-wrapper {
                padding: 15px;
            }

            .login-left {
                padding: 35px 25px;
            }

            .login-title {
                font-size: 30px;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }
    </style>


    <div class="login-wrapper">

        <div class="login-container">

            <!-- LEFT SIDE -->

            <div class="login-left">

                <div class="brand">

                    <div class="brand-logo">
                        S
                    </div>

                    <div class="brand-name">
                        SPITALSPORTS
                    </div>

                </div>


                <h1 class="login-title">
                    Welcome Back
                </h1>

                <p class="login-subtitle">
                    Login to your SPITALSPORTS account to continue.
                </p>


                <form method="POST" action="{{ route('login') }}">

                    @csrf


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label
                            for="email"
                            class="form-label"
                        >
                            Email Address
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-input"
                            placeholder="Enter your email"
                            required
                            autofocus
                            autocomplete="username"
                        >

                        @error('email')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label
                            for="password"
                            class="form-label"
                        >
                            Password
                        </label>

                        <div class="input-wrapper">

                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-input password-input"
                                placeholder="Enter your password"
                                required
                                autocomplete="current-password"
                            >

                            <button
                                type="button"
                                class="show-password"
                                onclick="togglePassword()"
                                id="passwordToggle"
                            >
                                Show
                            </button>

                        </div>

                        @error('password')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <!-- REMEMBER / FORGOT -->

                    <div class="form-options">

                        <label class="remember">

                            <input
                                type="checkbox"
                                name="remember"
                            >

                            <span>
                                Remember me
                            </span>

                        </label>


                        @if (Route::has('password.request'))

                            <a
                                href="{{ route('password.request') }}"
                                class="forgot-link"
                            >
                                Forgot Password?
                            </a>

                        @endif

                    </div>


                    <!-- LOGIN BUTTON -->

                    <button
                        type="submit"
                        class="login-button"
                    >
                        Login
                    </button>

                </form>


                <!-- REGISTER -->

                <div class="register-text">

                    Don't have an account?

                    <a
                        href="{{ route('register') }}"
                        class="register-link"
                    >
                        Create Account
                    </a>

                </div>

            </div>


            <!-- RIGHT SIDE -->

            <div class="login-right">

                <div class="right-content">

                    <div class="right-logo">
                        S
                    </div>

                    <h2 class="right-title">
                        SPITALSPORTS
                    </h2>

                    <h3 class="right-heading">
                        Reliable Manufacturing. Trusted Quality.
                    </h3>

                    <p class="right-description">
                        Welcome to SPITALSPORTS, your trusted manufacturing
                        partner. Explore quality products, manage your
                        orders and get reliable manufacturing solutions
                        from one platform.
                    </p>


                    <div class="features">

                        <div class="feature">

                            <div class="feature-icon">
                                ✓
                            </div>

                            <span>
                                Quality & Reliable Products
                            </span>

                        </div>


                        <div class="feature">

                            <div class="feature-icon">
                                ✓
                            </div>

                            <span>
                                Trusted Manufacturing Solutions
                            </span>

                        </div>


                        <div class="feature">

                            <div class="feature-icon">
                                ✓
                            </div>

                            <span>
                                Easy Product Ordering
                            </span>

                        </div>


                        <div class="feature">

                            <div class="feature-icon">
                                ✓
                            </div>

                            <span>
                                Dedicated Customer Support
                            </span>

                        </div>

                    </div>


                    <div class="trust-box">

                        Your trusted platform for quality
                        manufacturing products and services.

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>

        function togglePassword() {

            const password =
                document.getElementById('password');

            const button =
                document.getElementById('passwordToggle');

            if (password.type === 'password') {

                password.type = 'text';
                button.innerText = 'Hide';

            } else {

                password.type = 'password';
                button.innerText = 'Show';

            }

        }

    </script>

</x-guest-layout>

