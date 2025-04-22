@extends('frontend.usermaster')
@section('content')


<section class="vh-90 d-flex align-items-center bg-light py-5 px-4">
  <div class="container-fluid h-100">
    <div class="row h-100 align-items-center">
      
      <!-- Left Side: Text Content -->
      <div class="col-md-6 px-5">
        <h1 class="display-4 fw-bold">Offer!</h1>
        <h1 class="display-4 fw-bold">We Are Providing The Best Services !!</h1>
        <h1 class="display-4 fw-bold">{{ $activeHeroes->title }}</h1>
        <p class="lead">{{ $activeHeroes->description }}</p>
        <a href="{{ route('service') }}" class="btn btn-outline-dark mt-3">View Products</a>
      </div>

      <!-- Right Side: Image -->
      <div class="col-md-6 text-center d-flex justify-content-center">
        <img src="{{ asset($activeHeroes->url) }}" 
             alt="Banner Image" 
             class="img-fluid ms-md-5"
             style="max-height: 90vh; object-fit: contain; width: 100%; margin-right: 10%;">
      </div>

    </div>
  </div>
</section>



@endsection