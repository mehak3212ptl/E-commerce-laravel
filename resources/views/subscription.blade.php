<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Pricing</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8fbff;
      font-family: 'Poppins', sans-serif;
    }
    .pricing-section {
      padding: 60px 0;
      text-align: center;
    }
    .pricing-header h2 {
      font-weight: 700;
      margin-bottom: 10px;
    }
    .pricing-header p {
      max-width: 600px;
      margin: 0 auto 30px;
      color: #6c757d;
    }
    .pricing-toggle {
      margin-bottom: 50px;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .pricing-toggle label {
      margin: 0 10px;
      font-weight: 500;
    }
    .card {
      border: none;
      border-radius: 15px;
      transition: all 0.3s;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .price {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 10px;
    }
    .btn-get-started {
      margin-top: 20px;
      padding: 10px 25px;
      border-radius: 30px;
      font-weight: 500;
    }
    .basic-plan {
      background: linear-gradient(to bottom, #6dd5fa, #2980b9);
      color: #fff;
    }
    .basic-plan .btn-get-started {
      background: #fff;
      color: #2980b9;
      border: none;
    }
    .card .list-unstyled {
      text-align: left;
      margin-top: 20px;
    }
    .card .list-unstyled li {
      margin-bottom: 10px;
      position: relative;
      padding-left: 20px;
    }
    .card .list-unstyled li::before {
      content: "•";
      color: #0d6efd;
      font-size: 1.5rem;
      position: absolute;
      left: 0;
      top: -3px;
    }
    .basic-plan .list-unstyled li::before {
      color: #fff;
    }
  </style>
</head>
<body>
@vite(['resources/js/app.js'])
@if (Route::has('login'))
    <div class="position-absolute d-flex align-items-center top-0 end-0 p-3 text-end z-3">
      @auth
      @if((auth()->user()->hasRole('super-admin'))||(auth()->user()->hasRole('Admin')))  
      <x-nav-link   class="nav-link" :href="route('admindashboard')" :active="request()->routeIs('admindashboard')">
                  {{ __('Dashboard') }}
              </x-nav-link>
      @endif
 
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="dropdown-item text-start"
                  onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Log Out') }}
          </button>
        </form>
     
  </div>
</div>   
      @else
        <a href="{{ route('login') }}" class="fw-semibold text-secondary text-decoration-none me-2">Log in</a>
        @if (Route::has('register'))
          <a href="{{ route('register') }}" class="fw-semibold text-secondary text-decoration-none">Register</a>
        @endif
      @endauth
    </div>
  @endif





<section class="pricing-section">
  <div class="container">
    <div class="pricing-header mb-5">
      <h2>Choose a Plan With  Packages & Pricing</h2>
      <p>Perfect for events where attendees must register & pay to attend, such as Conferences, Training, Sports, Fundraising, and more.</p>
    </div>

    <div class="pricing-toggle">
      <label>Paid Products</label>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="eventSwitch" checked>
      </div>
      <label>Free Products</label>
    </div>

    <div class="row g-4">
  @foreach($plan as $plan)
    <div class="col-md-4">
      <div class="card p-4 h-100 {{ $plan->is_popular ? 'basic-plan text-white position-relative' : 'bg-white' }}">
        
        {{-- Popular Badge --}}
        @if($plan->is_popular)
          <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-warning mt-2">
            Popular
          </span>
        @endif

        {{-- Plan Name & Price --}}
        <h5 class="mt-4">{{ $plan->name }}</h5>
        <div class="price">{{ $plan->currency }} {{ number_format($plan->price, 2) }}</div>

        {{-- Plan Limits --}}
        <div class="mb-2">
          <small><strong>Make Websites:</strong> {{ $plan->max_websites }}</small><br>
          <small><strong>Total Storage:</strong> {{ $plan->storage_limit }} Products</small>
        </div>

        {{-- Features --}}
        <ul class="list-unstyled">
          @php
            $features = explode("\r\n", $plan->features[0]->description ?? '');
          @endphp
          @foreach($features as $feature)
            @if(trim($feature))
              <li>{{ $feature }}</li>
            @endif
          @endforeach
        </ul>

        {{-- CTA Button --}}
        <button 
                        class="btn-get-started "
                        data-bs-toggle="modal"
                        data-bs-target="#planModal"
                        data-name="{{ $plan->name }}"
                        data-price="{{ $plan->currency }} {{ number_format($plan->price, 2) }}"
                        data-id="{{ $plan->id }}"
                        onclick="updatePlanDetails('{{ $plan->id }}', '{{ $plan->name }}', '{{ $plan->currency }} {{ number_format($plan->price, 2) }}')"
                    >
                        Get started
                    </button>

      </div>
    </div>
  @endforeach
</div>

</section>
<div class="modal fade" id="planModal" tabindex="-1" aria-labelledby="planModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-5 shadow-sm">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="planModalLabel">Choose Your Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form id="tenantForm" method="POST">
                    @csrf
                    <div class="row g-4">
                        <!-- Name -->
                        <div class="col-md-6">
                            <x-input-label for="name" :value="('Name')" />
                            <x-text-input id="name" class="form-control shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <x-input-label for="email" :value="('Email')" />
                            <x-text-input id="email" class="form-control shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Domain Name -->
                        <div class="col-md-12">
                            <x-input-label for="domain_name" :value="('Domain Name')" />
                            <x-text-input id="domain_name" class="form-control shadow-sm" type="text" name="domain_name" :value="old('domain_name')" required />
                            <x-input-error :messages="$errors->get('domain_name')" class="mt-1" />
                        </div>

                        <!-- Password -->
                        <div class="col-md-6">
                            <x-input-label for="password" :value="('Password')" />
                            <x-text-input id="password" class="form-control shadow-sm" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6">
                            <x-input-label for="password_confirmation" :value="('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="form-control shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                        </div>

                        <!-- Hidden fields for plan data -->
                        <input type="hidden" id="plan_id" name="plan_id">
                        <input type="hidden" id="plan_name" name="plan_name">
                        <input type="hidden" id="plan_price" name="plan_price">

                        <!-- Plan Details Section -->
                        <div class="col-12 mt-3 text-center">
                            <p><strong>Plan Name:</strong> <span id="modalPlanName" class="text-muted"></span></p>
                            <p><strong>Price:</strong> <span id="modalPlanPrice" class="text-muted"></span></p>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer border-top-0 p-3">
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                <button type="button" id="razorpayButton" class="btn btn-primary rounded-pill px-4 ms-2">Pay Now</button>
            </div>
        </div>
    </div>
</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const planModal = document.getElementById('planModal');
  planModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;

    // Get data from button
    const name = button.getAttribute('data-name');
    const price = button.getAttribute('data-price');
    const id = button.getAttribute('data-id');

    // Update modal content
    document.getElementById('modalPlanName').textContent = name;
    document.getElementById('modalPlanPrice').textContent = price;

    // Optional: set buy link
    document.getElementById('modalBuyBtn').href = `/plans/checkout/${id}`;
  });
</script>




<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // When the Pay Now button is clicked
    document.getElementById('razorpayButton').addEventListener('click', function() {
        // Validate the form
        const form = document.getElementById('tenantForm');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        // Collect form data
        const formData = new FormData(form);
        const name = formData.get('name');
        const email = formData.get('email');
        const planName = document.getElementById('modalPlanName').textContent;
        const planPrice = document.getElementById('modalPlanPrice').textContent.replace(/[^0-9.]/g, '');

        // Create Razorpay order
        fetch('{{ route("razorpay.create.order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                amount: parseFloat(planPrice) * 100, // Razorpay expects amount in paise
                plan_id: formData.get('plan_id'),
                plan_name: formData.get('plan_name')
            })
        })
        .then(response => response.json())
        .then(data => {
            // Initialize Razorpay
            const options = {
                key: '{{ config("services.razorpay.key") }}',
                amount: data.amount,
                currency: 'INR',
                name: 'Your Company Name',
                description: planName + ' Subscription',
                order_id: data.order_id,
                prefill: {
                    name: name,
                    email: email
                },
                handler: function(response) {
                    // On successful payment, add payment details to form
                    const paymentField = document.createElement('input');
                    paymentField.type = 'hidden';
                    paymentField.name = 'razorpay_payment_id';
                    paymentField.value = response.razorpay_payment_id;
                    form.appendChild(paymentField);

                    const orderField = document.createElement('input');
                    orderField.type = 'hidden';
                    orderField.name = 'razorpay_order_id';
                    orderField.value = response.razorpay_order_id;
                    form.appendChild(orderField);

                    const signatureField = document.createElement('input');
                    signatureField.type = 'hidden';
                    signatureField.name = 'razorpay_signature';
                    signatureField.value = response.razorpay_signature;
                    form.appendChild(signatureField);

                    // Set form action and submit
                    form.action = '{{ route("tenant.store") }}';
                    form.submit();
                },
                modal: {
                    ondismiss: function() {
                        console.log('Payment cancelled');
                    }
                }
            };

            const razorpay = new Razorpay(options);
            razorpay.open();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing your payment. Please try again.');
        });
    });

    // Function to update plan details in modal
    window.updatePlanDetails = function(planId, planName, planPrice) {
        document.getElementById('plan_id').value = planId;
        document.getElementById('plan_name').value = planName;
        document.getElementById('plan_price').value = planPrice;
        document.getElementById('modalPlanName').textContent = planName;
        document.getElementById('modalPlanPrice').textContent = planPrice;
    };
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script>
    // Add entrance animation for cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.pricing-card');
        
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 300 + (index * 200));
        });
        
        // Modal functionality
        const planModal = document.getElementById('planModal');
        if (planModal) {
            planModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                if (button) {
                    // Get data from button
                    const name = button.getAttribute('data-name');
                    const price = button.getAttribute('data-price');
                    const id = button.getAttribute('data-id');
                    
                    // Update modal content
                    document.getElementById('modalPlanName').textContent = name;
                    document.getElementById('modalPlanPrice').textContent = price;
                    
                    // Update hidden form fields
                    document.getElementById('plan_id').value = id;
                    document.getElementById('plan_name').value = name;
                    document.getElementById('plan_price').value = price;
                }
            });
        }
    });
</script>



</body>
</html>
