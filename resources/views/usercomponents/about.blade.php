@extends('frontend.usermaster')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Creative UI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff;
    }

    .hero {
      padding: 60px 0;
      position: relative;
      background: #fff;
    }

    .hero-images {
      position: relative;
    }

    .hero-images img {
      border-radius: 8px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .hero-images .img1 {
      position: absolute;
      top: 0;
      left: 0;
      width: 180px;
    }

    .hero-images .img2 {
      position: absolute;
      top: 0;
      left: 130px;
      width: 220px;
    }

    .hero-images .img3 {
      position: absolute;
      bottom: 0;
      left: 80px;
      width: 120px;
      border: 4px solid #a259ff;
    }

    .purple-square {
      width: 20px;
      height: 20px;
      background-color: #a259ff;
      position: absolute;
    }

    .features-section {
      padding: 80px 0;
      background: #fff;
    }

    .feature-icon {
      width: 50px;
      height: 50px;
      background-color: #f6efff;
      color: #a259ff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 15px;
      font-size: 24px;
    }

    .section-divider {
      height: 2px;
      background-color: #eee;
      margin: 60px 0;
    }
  </style>
</head>
<body>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="row align-items-center">
        <!-- Image Area -->
        <div class="col-md-6 position-relative">
          <div class="hero-images" style="height: 300px;">
            <img src="{{ asset('Upload/Banner/6803db5dad357.jpg') }}" class="img1" alt="">
            <img src="{{ asset('Upload/Banner/6803db5dad357.jpg') }}" class="img2" alt="">
            <img src="{{ asset('Upload/Banner/68038afd37886.jpg') }}" class="img3" alt="">

            <div class="purple-square" style="top: 50px; left: 230px;"></div>
            <div class="purple-square" style="bottom: 10px; left: 20px;"></div>
          </div>
        </div>

        <!-- Text Area -->
        <div class="col-md-6">
          <h6 class="text-uppercase text-primary fw-bold mb-2">Download Rotona</h6>
          <h2 class="fw-bold mb-3">Best way to show your Creativity</h2>
          <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt.</p>
          <a href="#" class="text-decoration-none text-primary fw-bold">Full Story →</a>
        </div>
      </div>
    </div>
  </section>

  <div class="section-divider"></div>

  <!-- Features Section -->
  <section class="features-section">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4 mb-5">
          <div class="feature-icon"><i class="bi bi-stack"></i></div>
          <h5>Quality Matters</h5>
          <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod.</p>
        </div>
        <div class="col-md-4 mb-5">
          <div class="feature-icon"><i class="bi bi-phone"></i></div>
          <h5>Responsive Design</h5>
          <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod.</p>
        </div>
        <div class="col-md-4 mb-5">
          <div class="feature-icon"><i class="bi bi-lightning-charge"></i></div>
          <h5>Fast Loading</h5>
          <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod.</p>
        </div>
        <div class="col-md-4 mb-5">
          <div class="feature-icon"><i class="bi bi-tools"></i></div>
          <h5>Easy Customization</h5>
          <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod.</p>
        </div>
        <div class="col-md-4 mb-5">
          <div class="feature-icon"><i class="bi bi-shield-lock"></i></div>
          <h5>Total Security</h5>
          <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod.</p>
        </div>
        <div class="col-md-4 mb-5">
          <div class="feature-icon"><i class="bi bi-star"></i></div>
          <h5>Quality Matters</h5>
          <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


@endsection