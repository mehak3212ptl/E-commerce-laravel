<?php

namespace App\Http\Controllers;

use App\Models\hero;
use App\Models\category;
use App\Models\Userabout;
use Illuminate\Http\Request;
use App\Models\ProductsModel;

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


}
