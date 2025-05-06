@extends('frontend.usermaster')
@section('content')

<h2 class="text-center">Our Products</h2>


<div class="text-center my-4">
  <div class="btn-group" role="group" aria-label="Category Filters">
    
    <a href="{{ route('service') }}" class="btn btn-outline-dark filter-btn">All</a>

    @foreach($categories as $category)
      <button class="btn btn-outline-dark filter-btn" data-id="{{ $category->id }}">
        {{ $category->categoryname }}
      </button>
    @endforeach

  </div>
</div>

<div class="container my-5">
  <div class="row" id="product-list">
    @foreach($products1 as $product)
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
        <img src="/Upload/products/{{ basename($product->image) }}" class="card-img-top" style="height:250px; object-fit:cover;">
          <div class="card-body">
            <h5>Product Name:{{ $product->name }}</h5>
            <p>Description:{{ $product->description }}</p>
            <h5>Price:{{ $product->price }}</h5>
            <a href="{{ url ('detail', ['id' => $product->id] ) }}" class="btn btn-success w-100">View Product Details</a>
            <form action="{{ url('/wishlist/add/' . $product->id) }}" method="POST" class="mt-2">
              @csrf
              <button type="submit" class="btn btn-outline-danger w-100">Add to Wishlist ❤️</button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('.filter-btn').on('click', function() {
    let cat_id = $(this).data('id');

    $.ajax({
      url: `/products/filter/${cat_id}`,
      type: 'GET',
      success: function(data) {
        let html = '';
        data.forEach(product => {
          html += `
            <div class="col-md-4 mb-4">
              <div class="card h-100 shadow-sm">
                <img src="/${product.image}" class="card-img-top" style="height:250px; object-fit:cover;">
                <div class="card-body">
                  <h5>Product Name :${product.name}</h5>
                  <p>Description:${product.description}</p>
                 <h5>Price:${product.price}</h5>                
                  <a href="/detail/${product.id}" class="btn btn-success w-100">View Product Details</a>

                </div>
              </div>
            </div>
          `;
        });
        $('#product-list').html(html);
      }
    });
  });
</script>

@endsection
