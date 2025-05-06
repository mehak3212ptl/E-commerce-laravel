@extends('frontend.usermaster')
@section('content')

<body style="background-color: #f8f9fa;">

<div class="container py-5">
  <h2 class="text-center mb-4">Contact Us</h2>
  <div class="row g-4">

    <!-- Contact Form -->
    <div class="col-lg-6">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <form action="/send-message" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Your Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Your Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-success w-100">Send Message</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Contact Info and Map -->
    <div class="col-lg-6">
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
          <h5>Contact Information</h5>
          <p><strong>Email:</strong> support@yourstore.com</p>
          <p><strong>Phone:</strong> +91 98765 43210</p>
          <p><strong>Address:</strong> 123, Main Road, Delhi, India</p>
        </div>
      </div>

      <!-- Google Map Embed -->
      <div class="ratio ratio-16x9">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224345.8390853356!2d77.06889750805872!3d28.52758200606986!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce3e5b6e3786b%3A0x6ec5a5761e1f0de!2sDelhi!5e0!3m2!1sen!2sin!4v1704100012345" 
          width="100%" 
          height="300" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy">
        </iframe>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection