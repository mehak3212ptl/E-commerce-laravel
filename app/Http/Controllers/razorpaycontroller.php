<?php

namespace App\Http\Controllers;

use Exception;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class RazorpayController extends Controller
{
    public function payment(Request $request)
{
    $razorpayPaymentId = $request->input('razorpay_payment_id');

    if ($razorpayPaymentId) {
        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payment = $api->payment->fetch($razorpayPaymentId);
            $response = $payment->capture(['amount' => $payment['amount']]);

            // Store order details
            $order = new Order;
            $order->payment_id = $response['id'];
            $order->amount = $response['amount'] / 100;
            $order->status = $response['status'];
            $order->name = $request->input('name'); // Assuming you have this field in the form
            $order->email = $request->input('email'); // Assuming you have this field in the form
            $order->save();

            return redirect()->route('order.success', $order->id)->with('success', 'Payment successful!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    return redirect()->back()->with('error', 'Payment ID not found.');
}


    public function orderSuccess($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        return view('paymentsuccess', compact('order'));
    }



    public function createOrder(Request $request)
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        
        $orderData = [
            'receipt' => 'order_' . uniqid(),
            'amount' => $request->amount, // amount in paise
            'currency' => 'INR',
            'notes' => [
                'plan_id' => $request->plan_id,
                'plan_name' => $request->plan_name
            ]  
        ];

        $order = $api->order->create($orderData);

        return response()->json([
            'order_id' => $order->id,
            'amount' => $order->amount
        ]);
    }
}
