@extends('frontend.usermaster')
@section('content')

<h2 class="text-center mb-5">Product Details</h2>

<div class="container my-5 bg-light py-5 px-4">
  <div class="row d-flex align-items-center">
    <div class="col-md-6 text-center">
      <img src="/Upload/products/{{ basename($products1->image) }}"
           class="img-fluid rounded shadow-sm"
           style="max-height: 350px; object-fit: cover;">
    </div>
    <div class="col-md-6">
      <h2>Product Name: {{ $products1->name }}</h2>
      <p>Product Details: {{ $products1->description }}</p>
      <h4>Price (per item): ₹<span id="unit-price">{{ $products1->price }}</span></h4>

      <div class="d-flex align-items-center my-3">
        <button class="btn btn-outline-secondary" onclick="decrementQty()">−</button>
        <input type="text" id="quantity"
               class="form-control mx-2 text-center"
               style="width: 60px;"
               value="1" readonly>
        <button class="btn btn-outline-secondary" onclick="incrementQty()">＋</button>
      </div>

      <h4 class="text-success mt-4">
        Total Price: ₹<span id="total-price">{{ $products1->price }}</span>
      </h4>

      <form action="{{ url('stripe/checkout') }}" method="POST" id="stripe-payment-form">
        @csrf
        <input type="hidden" name="product_name" value="{{ $products1->name }}">
        <input type="hidden" name="quantity" id="stripe-quantity" value="1">
        <input type="hidden" name="amount" id="stripe-amount" value="{{ $products1->price * 100 }}">
        
        <button type="submit" class="btn btn-primary mt-3">
          Pay with Stripe
        </button>
      </form>
    </div>
  </div>
</div>

<script>
  const qtyInput     = document.getElementById('quantity');
  const totalDisplay = document.getElementById('total-price');
  const unitPrice    = parseFloat(document.getElementById('unit-price').textContent);
  const formQty      = document.getElementById('stripe-quantity');
  const formAmount   = document.getElementById('stripe-amount');

  function updateTotals() {
    const qty = parseInt(qtyInput.value, 10);
    const total = qty * unitPrice;
    totalDisplay.textContent = total.toFixed(2);
    formQty.value = qty;
    formAmount.value = Math.round(total * 100); // paise
  }

  function incrementQty() {
    qtyInput.value = parseInt(qtyInput.value,10) + 1;
    updateTotals();
  }

  function decrementQty() {
    if (qtyInput.value > 1) {
      qtyInput.value = parseInt(qtyInput.value,10) - 1;
      updateTotals();
    }
  }
</script>
@endsection
