@extends('frontend.usermaster')
@section('content')

<h2 class="text-center mb-5">My Wishlist</h2>

<div class="container my-5">
  @if($products->isEmpty())
    <p class="text-center">Your wishlist is empty.</p>
  @else
    <div class="row">
      @foreach($products as $product)
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="{{ asset($product->image) }}" class="card-img-top" style="height:250px; object-fit:cover;">
            <div class="card-body">
              <h5>Product Name: {{ $product->name }}</h5>
              <p>Description: {{ $product->description }}</p>
              <h5>Price: {{ $product->price }}</h5>
              <a href="{{ route ('detail', ['id' => $product->id] ) }}" class="btn btn-success w-100">View Product Details</a>
              <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Remove from Wishlist 🗑️</button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>

@endsection
