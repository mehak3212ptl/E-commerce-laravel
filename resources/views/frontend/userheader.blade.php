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
          <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('aboutus') }}">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('service') }}">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('blogs') }}">Blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('contact') }}">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('wishlist') }}">Wishlist</a>
        </li>
     
       
      </ul>


</div>



<!-- Auth Links (Login/Register) -->
<div class="d-flex align-items-center right-section">
  <form class="d-flex me-3">
    <input class="form-control form-control-sm" type="search" placeholder="Search" aria-label="Search">
  </form>

  
<form method="POST" action="{{ url('tenantlogout') }}">
          @csrf
          <button type="submit" class="dropdown-item text-start"
                  onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Log Out') }}
          </button>
        </form>

  <div class="auth-links d-flex align-items-center me-3">
    @auth
        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
    @else
        <a href="{{ url('tenantlogin') }}" class="nav-link">Login</a>
        @if (Route::has('register'))
            <a href="{{ url('tenantregister') }}" class="nav-link ms-3">Register</a>
        @endif
    @endauth
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
