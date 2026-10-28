<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Ration Store</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
</head>

<body>

    <div class="login-page">

        <div class="login-box">

            <!-- Logo and Heading -->
            <div class="text-center mb-4">

                <i class="bi bi-basket2-fill login-logo"></i>

                <h3 class="fw-bold mt-2">Ration Store</h3>

                <p class="text-secondary">Sign in to your account</p>

            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- General Error Message -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div id="loginAlert" class="alert alert-danger d-none"></div>
            <form id="loginForm" action="{{ route('login.store') }}" method="POST" novalidate>

                @csrf

                <!-- Email -->
                <div class="mb-3">

                    <label for="email" class="form-label">
                        Email
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter your email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >

                    </div>

                    @error('email')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <!-- Password -->
                <div class="mb-3">

                    <label for="password" class="form-label">
                        Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter your password"
                            required
                        >

                    </div>

                    @error('password')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <!-- Remember Me -->
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div class="form-check">

                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            value="1"
                            class="form-check-input"
                        >

                        <label for="remember" class="form-check-label">
                            Remember me
                        </label>

                    </div>

                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Login
                </button>

            </form>

        </div>

        <!-- Footer -->
        <p class="login-footer">
            Ration Store Management System v1.0
        </p>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>const LOGIN = "{{ route('login.store') }}";</script>
<script src="{{ asset('assets/js/login.js') }}"></script>
</body>
</html>