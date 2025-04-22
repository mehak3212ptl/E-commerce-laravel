<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('about') }}">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('contact') }}">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('service') }}">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('blogs') }}">Blogs</a>
        </li>
       
        
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>MYSA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    .nav-link {
      color: #000 !important;
      font-weight: 500;
      margin-right: 1rem;
    }

    .nav-link:hover {
      text-decoration: underline;
    }

    .auth-links a {
      font-weight: 500;
      color: #000;
      margin-left: 1rem;
      text-decoration: none;
    }

    .auth-links a:hover {
      text-decoration: underline;
    }

    .social-icons a {
      color: #000;
      margin-left: 0.75rem;
      font-size: 1.1rem;
    }

    .social-icons a:hover {
      color: #0d6efd;
    }

    @media (max-width: 991.98px) {
      .navbar-collapse {
        flex-direction: column;
      }
      .navbar-nav {
        align-items: flex-start;
      }
      .right-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
        margin-top: 1rem;
      }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white px-5">
  <div class="container-fluid">
    <!-- Hamburger Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible Content -->
    <div class="collapse navbar-collapse justify-content-between" id="navbarContent">

      <!-- Left Side: Navigation -->
      <ul class="navbar-nav mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('about') }}">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('service') }}">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('blogs') }}">Blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('contact') }}">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('wishlist') }}">Wishlist</a>
        </li>
      </ul>

      <!-- Right Side: Search + Login/Register + Socials -->
      <div class="d-flex align-items-center right-section">
        <!-- Search -->
        <form class="d-flex me-3">
          <input class="form-control form-control-sm" type="search" placeholder="Search" aria-label="Search">
        </form>

        <!-- Auth Links -->
        <div class="auth-links d-flex align-items-center me-3">
          <a href="{{ route('login') }}">Login</a>
          <a href="{{ route('register') }}">Register</a>
        </div>

        <!-- Social Icons -->
        <div class="social-icons d-flex align-items-center">
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-telegram-plane"></i></a>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
      </div>

    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
