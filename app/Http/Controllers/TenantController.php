<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use App\Models\Tenant;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants=Tenant::with('domains')->get();
        // dd($tenants);
        return view('tenancy.index',compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenancy.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'domain_name' => 'required|string|max:255|unique:domains,domain',
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'plan_id' => 'required|exists:plans,id',
        'razorpay_payment_id' => 'required|string',
        'razorpay_order_id' => 'required|string',
        'razorpay_signature' => 'required|string',
    ]);

    // Verify the payment signature
    try {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        
        // This is the correct way to verify payment
        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];
        
        $api->utility->verifyPaymentSignature($attributes);
        
        // Continue with tenant creation only if payment verification succeeds
        $tenant = Tenant::create([
            'name' => $validData['name'],
            'email' => $validData['email'],
            'password' => $validData['password'],
        ]);
        
        $tenant->domains()->create([
            'domain' => $validData['domain_name'] . '.' . config('app.domain')
        ]);
        
        // Create payment record
        Payment::create([
            'tenant_id' => $tenant->id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_order_id' => $request->razorpay_order_id,
            'amount' => $request->plan_price,
            'status' => 'completed',
        ]);
        
        return redirect()->route('tenant.success')->with('success', 'Your account has been created successfully!');
    } catch (\Exception $e) {
        // Log the actual exception for debugging
        \Log::error('Razorpay payment verification failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Payment verification failed. Please try again.');
    }
}
    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}