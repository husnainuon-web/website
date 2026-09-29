<x-guest-layout>

    <style>
        body {
            background: #edf5ef;
            font-family: Arial, Helvetica, sans-serif;
        }

        .topbar {
            height: 76px;
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid #dce9e1;
            padding: 0 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #15803d, #1c8c49);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 900;
            box-shadow: 0 12px 25px rgba(21, 128, 61, 0.22);
        }

        .brand-name {
            color: #14532d;
            font-weight: 900;
            letter-spacing: 2px;
            font-size: 22px;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-btn {
            text-decoration: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .nav-btn-outline {
            color: #15803d;
            border: 1px solid rgba(21, 128, 61, 0.45);
            background: #fff;
        }

        .nav-btn-outline:hover {
            background: #f0fdf4;
        }

        .nav-btn-primary {
            color: #fff;
            background: linear-gradient(135deg, #15803d, #1c8c49);
            box-shadow: 0 12px 24px rgba(21, 128, 61, 0.18);
        }

        .nav-btn-primary:hover {
            background: linear-gradient(135deg, #116b34, #176c3d);
        }

        .auth-shell {
            min-height: calc(100vh - 76px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 38px 20px;
        }

        .auth-card {
            width: min(1100px, 100%);
            display: grid;
            grid-template-columns: 1fr 1.05fr;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid #dce9e1;
            box-shadow: 0 20px 55px rgba(20, 83, 45, 0.12);
        }

        .auth-side {
            background: linear-gradient(145deg, #14532d, #15803d, #16a34a);
            color: #fff;
            padding: 58px 46px;
            position: relative;
            display: flex;
            align-items: center;
        }

        .auth-side::before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.18);
            right: -120px;
            top: -80px;
        }

        .auth-side::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.12);
            left: -80px;
            bottom: -90px;
        }

        .info-content {
            position: relative;
            z-index: 1;
        }

        .spotlite-logo {
            width: 62px;
            height: 62px;
            border-radius: 16px;
            background: rgba(255,255,255,0.16);
            border: 1px solid rgba(255,255,255,0.28);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: 900;
            margin-bottom: 18px;
        }

        .info-brand {
            font-size: 30px;
            font-weight: 900;
            letter-spacing: 3px;
            margin-bottom: 10px;
        }

        .info-heading {
            font-size: 28px;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 18px;
        }

        .info-text {
            font-size: 15px;
            line-height: 1.8;
            color: rgba(255,255,255,0.88);
            margin-bottom: 28px;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            font-size: 14px;
            font-weight: 600;
        }

        .feature-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(255,255,255,0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 700;
        }

        .auth-form-area {
            padding: 52px 46px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-box {
            width: min(100%, 480px);
        }

        .form-kicker {
            color: #16a34a;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .form-title {
            color: #17251d;
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .form-subtitle {
            color: #6b7280;
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            color: #26352d;
            font-size: 14px;
            font-weight: 700;
            display: block;
            margin-bottom: 7px;
        }

        .form-control {
            width: 100%;
            height: 46px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            padding: 10px 13px;
            font-size: 14px;
            background: #fff;
            color: #111827;
        }

        .form-control:focus {
            outline: none;
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22,163,74,0.10);
        }

        .password-box {
            position: relative;
        }

        .password-box .form-control {
            padding-right: 76px;
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

        .checkbox-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin: 10px 0 22px;
            font-size: 14px;
            color: #4b5563;
        }

        .remember-wrap {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .remember-wrap input {
            accent-color: #15803d;
        }

        .hint-link {
            color: #15803d;
            font-weight: 700;
            text-decoration: none;
        }

        .hint-link:hover {
            text-decoration: underline;
        }

        .primary-btn {
            width: 100%;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #15803d, #1c8c49);
            color: #fff;
            padding: 13px 16px;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 12px 24px rgba(21, 128, 61, 0.18);
        }

        .primary-btn:hover {
            background: linear-gradient(135deg, #116b34, #176c3d);
        }

        .auth-footer {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin-top: 22px;
        }

        .auth-footer a {
            color: #15803d;
            font-weight: 700;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .error-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            border-radius: 10px;
            padding: 11px 12px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
        }

        @media (max-width: 900px) {
            .auth-card {
                grid-template-columns: 1fr;
            }

            .auth-side {
                padding: 40px 30px;
            }

            .auth-form-area {
                padding: 35px 25px;
            }
        }

        @media (max-width: 600px) {
            .topbar {
                padding: 0 20px;
            }

            .brand-name {
                font-size: 18px;
            }

            .nav-btn {
                padding: 8px 12px;
            }
        }
    </style>

    <div class="topbar">
        <a href="{{ url('/') }}" class="brand">
            <div class="logo">S</div>
            <div class="brand-name">SPOTLITE</div>
        </a>

        <div class="nav-actions">
            <a href="{{ route('login') }}" class="nav-btn nav-btn-outline">Login</a>
            <a href="{{ route('register') }}" class="nav-btn nav-btn-primary">Register</a>
        </div>
    </div>

    <div class="auth-shell">
        <div class="auth-card">

            <aside class="auth-side">
                <div class="info-content">
                    <div class="spotlite-logo">S</div>
                    <div class="info-brand">SPOTLITE</div>

                    <div class="info-heading">
                        Service that keeps<br>
                        your business moving.
                    </div>

                    <div class="info-text">
                        Sign in to your SPOTLITE account to track orders, review quotations,
                        manage products, and stay connected with our support team.
                    </div>

                    <ul class="feature-list">
                        <li><span class="feature-icon">✓</span> Quick access to your order history</li>
                        <li><span class="feature-icon">✓</span> Manage quotes and support requests</li>
                        <li><span class="feature-icon">✓</span> Customer-first manufacturing services</li>
                        <li><span class="feature-icon">✓</span> Secure account access</li>
                    </ul>
                </div>
            </aside>

            <section class="auth-form-area">
                <div class="form-box">
                    <div class="form-kicker">Welcome back</div>
                    <h1 class="form-title">Login to Spotlite</h1>
                    <p class="form-subtitle">
                        Access your dashboard to review products, orders, quotations, and support activity.
                    </p>

                    @if ($errors->any())
                        <div class="error-box">
                            Please check your email address and password.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="form-label">Email address</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control"
                                placeholder="Enter your email address"
                                required
                                autofocus
                                autocomplete="username"
                                style="text-transform: lowercase;"
                            >
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <div class="password-box">
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Enter your password"
                                    required
                                    autocomplete="current-password"
                                >
                                <button type="button" class="show-password" onclick="togglePassword('password', this)">Show</button>
                            </div>
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="checkbox-row">
                            <label class="remember-wrap">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>Remember me</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="hint-link" href="{{ route('password.request') }}">Forgot password?</a>
                            @endif
                        </div>

                        <button type="submit" class="primary-btn">Log in</button>

                        <div class="auth-footer">
                            Don't have an account?
                            <a href="{{ route('register') }}">Create one now</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);

            if (input.type === 'password') {
                input.type = 'text';
                button.textContent = 'Hide';
            } else {
                input.type = 'password';
                button.textContent = 'Show';
            }
        }
    </script>
</x-guest-layout>
