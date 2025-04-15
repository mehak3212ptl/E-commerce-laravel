<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | YourApp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .form-control:invalid {
        border-color: #dc3545;
    }
    .text-danger small {
        display: block;
    }
  </style>
</head>
<body>
  <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                  <form method="POST" action="{{ route('register') }}" class="mx-1 mx-md-4">
                    @csrf

                    <!-- Name -->
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0 w-100">
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                        <label class="form-label" for="name">Your Name</label>
                        @error('name')
                          <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                      </div>
                    </div>

                    <!-- Email -->
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0 w-100">
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        <label class="form-label" for="email">Your Email</label>
                        @error('email')
                          <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                      </div>
                    </div>

                    <!-- Password -->
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0 w-100">
                        <input type="password" id="password" name="password" class="form-control" required>
                        <label class="form-label" for="password">Password</label>
                        @error('password')
                          <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                      </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0 w-100">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        <label class="form-label" for="password_confirmation">Repeat your password</label>
                        @error('password_confirmation')
                          <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                      </div>
                    </div>

                    <!-- Terms Checkbox (Optional) -->
                    <div class="form-check d-flex justify-content-center mb-5">
                      <input class="form-check-input me-2" type="checkbox" id="terms" required />
                      <label class="form-check-label" for="terms">
                        I agree to the <a href="#">Terms of Service</a>
                      </label>
                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-dark btn-lg">Register</button>
                    </div>

                    <!-- Already registered -->
                    <div class="text-center">
                      <a href="{{ route('login') }}">Already registered?</a>
                    </div>
                  </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                    class="img-fluid" alt="Sample image">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap & Font Awesome -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
