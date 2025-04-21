<?php

namespace App\Http\Controllers;

use App\Models\hero;
use App\Models\category;
use Illuminate\Http\Request;
use App\Models\ProductsModel;

class Usercontroller extends Controller
{
    
public function index()
{
    $activeHeroes = hero::where('status', 1)->first(); 
    return view('usercomponents/home', compact('activeHeroes'));
}

public function about(){
    return view('usercomponents/about');       
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


public function filter($category_id)
{   
    $products1 = ProductsModel::latest()->get();
    $products1 = ProductsModel::where('category_id', $category_id)->get();
    return response()->json($products1);
}





}
