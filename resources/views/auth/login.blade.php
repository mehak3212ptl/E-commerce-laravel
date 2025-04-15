<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | YourApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff9c4; /* Light yellow */
        }
        .form-container {
            background-color:rgb(20, 19, 19); /* Red */
            border-radius: 15px;
            padding: 2rem;
        }
    </style>
</head>
<body>

<section class="vh-100">
    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">

            <!-- Left Image -->
            <div class="col-md-6 text-center">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                     class="img-fluid" alt="Phone image">
            </div>

            <!-- Right Form -->
            <div class="col-md-6">
                <div class="form-container text-white">

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <h3 class="mb-4 text-white">Sign In</h3>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="text-warning mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <div class="text-warning mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-light btn-lg w-100">Log in</button>

                        <!-- Forgot password -->
                        <div class="mt-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-white">Forgot your password?</a>
                            @endif
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
