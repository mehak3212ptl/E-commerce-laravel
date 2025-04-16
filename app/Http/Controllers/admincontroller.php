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

    public function viewproduct()
    {
    $products = ProductsModel::latest()->get();
    return view('admincomponents.viewproduct', compact('products')) ;
    }
    
    
}
