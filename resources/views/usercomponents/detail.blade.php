@extends('frontend.usermaster')
@section('content')

<h2 class="text-center mb-5">Product Details</h2>

<div class="container my-5 bg-light  py-5 px-4">
  <div class="row d-flex align-items-center">
    <div class="col-md-6 text-center">
      <img src="{{ asset($products1->image) }}"
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

      <form action="{{ route('razorpay.payment') }}"
            method="POST"
            id="payment-form">
        @csrf
        <!-- hidden fields to be filled by JS -->
        <input type="hidden" name="product_id" value="{{ $products1->id }}">
        <input type="hidden" name="quantity" id="form-quantity" value="1">
        <input type="hidden" name="amount" id="form-amount" value="{{ $products1->price * 100 }}">
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">

        <button type="button" id="rzp-button" class="btn btn-primary mt-3">
          Pay Now
        </button>
      </form>

    </div>
  </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  const qtyInput      = document.getElementById('quantity');
  const totalDisplay  = document.getElementById('total-price');
  const unitPrice     = parseFloat(document.getElementById('unit-price').textContent);
  const btnPay        = document.getElementById('rzp-button');
  const formQuantity  = document.getElementById('form-quantity');
  const formAmount    = document.getElementById('form-amount');

  function updateTotals() {
    const qty   = parseInt(qtyInput.value, 10);
    const total = qty * unitPrice;
    totalDisplay.textContent = total.toFixed(2);
    formQuantity.value = qty;
    formAmount.value   = Math.round(total * 100); // paise, integer
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

  btnPay.onclick = function(e) {
    e.preventDefault();
    const amountPaise = parseInt(formAmount.value, 10);

    const options = {
      key:        "{{ config('services.razorpay.key') }}",
      amount:     amountPaise,
      currency:   "INR",
      name:       "{{ config('app.name') }}",
      description: "Payment for {{ $products1->name }}",
      image:      "{{ asset('logo.png') }}",
      handler: function (response) {
        // fill hidden form fields and submit
        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        document.getElementById('razorpay_order_id').value   = response.razorpay_order_id;
        document.getElementById('razorpay_signature').value  = response.razorpay_signature;
        document.getElementById('payment-form').submit();
      },
      prefill: {
        name:  "{{ Auth::user()->name ?? '' }}",
        email: "{{ Auth::user()->email ?? '' }}",
      },
      theme: {
        color: "#3399cc"
      }
    };
    const rzp = new Razorpay(options);
    rzp.open();
  };
</script>
@endsection