<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\hero;
use App\Models\category;
use App\Models\Userabout;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\ProductsModel;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class Usercontroller extends Controller
{
    
public function index1()
{
    $activeHeroes = hero::where('status', 1)->first(); 
    return view('usercomponents/home', compact('activeHeroes'));
}

public function about(){

    $about = Userabout::latest()->first();
    return view('usercomponents/about',compact('about'));       
}

public function contact(){
    return view('usercomponents/contact');       
}

public function blogs(){
    return view('usercomponents/blogs');       
}



public function service(){
    $categories = category::all();
    $products1 = ProductsModel::latest()->get();
    return view('usercomponents/service', compact('products1','categories'));       
}

public function detail($id){
    $products1 = ProductsModel::findOrFail($id);
    return view('usercomponents/detail', compact('products1'));       
}

public function filter($category_id)
{  
    $products1 = ProductsModel::latest()->get();
    $products1 = ProductsModel::where('category_id', $category_id)->get();
    return response()->json($products1);
}




public function index(Request $request)
{
    $wishlist = $request->session()->get('wishlist', []);
    $products = ProductsModel::whereIn('id', $wishlist)->get();
    return view('usercomponents.wishlist', compact('products'));
}

public function add(Request $request, $id)
{
    $wishlist = $request->session()->get('wishlist', []);
    if (!in_array($id, $wishlist)) {
        $wishlist[] = $id;
        $request->session()->put('wishlist', $wishlist);
    }
    return redirect()->back()->with('success', 'Product added to wishlist.');
}

public function remove(Request $request, $id)
{
    $wishlist = $request->session()->get('wishlist', []);
    if (($key = array_search($id, $wishlist)) !== false) {
        unset($wishlist[$key]);
        $request->session()->put('wishlist', $wishlist);
    }
    return redirect()->back()->with('success', 'Product removed from wishlist.');
}

public function success(Request $request){

    if ($request->query('payment') === 'success') {
        // Assuming you passed user's email via session or query
        $email = $request->query('email'); // e.g., ?payment=success&email=someone@example.com

        if ($email) {
            Mail::raw('Thank you for your purchase! Your order was successful.', function ($message) use ($email) {
                $message->to($email)
                        ->subject('Order Confirmation');
            });

            return view('usercomponents/success');
        }

        return response('Email not provided.', 400);
    }

    return response('Payment not successful.', 400);
    // return view('usercomponents/success');       
}


public function checkout(Request $request)
{
 

        // Validate incoming data
        $request->validate([
            'email'        => 'required|email',
            'amount'       => 'required|integer|min:1',
            'product_name' => 'required|string',
            'quantity'     => 'required|integer|min:1',
        ]);
    
        Stripe::setApiKey(config('services.stripe.secret'));
    
        $session = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency'     => 'inr',
                    'unit_amount'  => $request->amount, // amount in paise
                    'product_data' => [
                        'name' => $request->product_name,
                    ],
                ],
                'quantity' => $request->quantity,
            ]],
            'mode' => 'payment',
            'success_url' => url('success') . '?payment=success&email=' . urlencode($request->email),
            'cancel_url'  => url('/') . '?payment=cancel',
        ]);
    
        return redirect($session->url);
    }
    
}


