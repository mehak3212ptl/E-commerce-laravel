<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsModel;

class admincontroller extends Controller
{
    
    public function index()
    {  
    return view('admincomponents.cards') ;
    }

    public function users()
    {  
    return view('admincomponents.users') ;
    }
    public function settings()
    {  
    return view('admincomponents.settings') ;
    }

    public function viewproduct()
    {
    // $products = ProductsModel::latest()->get();
    $products = ProductsModel::with('category')->get();
    return view('admincomponents.viewproduct', compact('products')) ;
    }
    
    
}
