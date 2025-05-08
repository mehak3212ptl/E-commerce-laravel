@extends('frontend.usermaster')
@section('content')


<section class="vh-90 d-flex align-items-center bg-light py-5 px-4">
  <div class="container-fluid h-100">
    <div class="row h-100 align-items-center">
      
      <!-- Left Side: Text Content -->
      <div class="col-md-6 px-5">
        <h1 class="display-4 fw-bold">Offer!</h1>
        <h1 class="display-4 fw-bold">We Are Providing The Best Services !!</h1>

@if ($activeHeroes)
    <!-- Dynamic Content -->
    <h5 class="card-title">{{ $activeHeroes->title }}</h5>
    <h5 class="card-title">{{ $activeHeroes->description }}</h5>
    <a href="{{ route('service') }}" class="btn btn-outline-dark mt-3">View Products</a>
</div>

<!-- Right Side: Image -->
<div class="col-md-6 text-center d-flex justify-content-center">
<img src="Upload/Banner/{{ basename($activeHeroes->url) }}"  class="card-img-top" alt="{{ $activeHeroes->title }}"
             alt="Banner Image" 
             class="img-fluid ms-md-5"
             style="max-height: 90vh; object-fit: contain; width: 100%; margin-right: 10%;">
</div>

@else
    <!-- Static Fallback Content -->
    <h5 class="card-title">Welcome to Our Services</h5>
    <h5 class="card-title">We offer top-notch quality and customer satisfaction.</h5>
    <a href="{{ route('service') }}" class="btn btn-outline-dark mt-3">Explore Our Services</a>
</div>

@php
    $staticImage = 'images/IMG-20250412-WA0005.jpg'; // Make sure this file exists
@endphp
<div class="col-md-6 text-center d-flex justify-content-center">
    <img src="{{ $staticImage }}" 
         class="img-fluid ms-md-5"
         style="max-height: 90vh; object-fit: contain; width: 100%; margin-right: 10%;"
         alt="Default Banner Image">
@endif

    </div>
  </div>
</section>



<div class="video-container">
    
    <div class="embed-responsive embed-responsive-16by9">
    <iframe width="100%" height="500" src="https://www.youtube.com/embed/hHqW0gtiMy4?si=G690S8UVIeHtHdBF" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>    </div>
</div>


<!-- 
<div class="container">
    @if($activeHeroes)
        <div class="card">
            @if($activeHeroes->image)
                <img src="{{ asset('storage/' . $activeHeroes->image) }}" class="card-img-top" alt="{{ $activeHeroes->title }}">
            @endif
            <div class="card-body">
                <h2 class="card-title">{{ $activeHeroes->title }}</h2>
                <p class="card-text">{!! $activeHeroes->description !!}</p>
            </div>
        </div>
    @else
        <p>No active hero found.</p>
    @endif
</div> -->

@endsection