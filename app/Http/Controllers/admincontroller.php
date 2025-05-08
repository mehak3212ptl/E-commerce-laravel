<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\category;
use Illuminate\Http\Request;
use App\Models\ProductsModel;

class admincontroller extends Controller
{
    
    public function index()
    {  
    $products1 = ProductsModel::latest()->get();
    $countproducts=$products1->count();
    $user=User::get()->count();
    $products = ProductsModel::with('category')->get()->count();
   
    return view('admincomponents.cards',compact('countproducts','user','products')) ;
    }


    public function settings()
    {  
    return view('admincomponents.settings') ;
    }
    

    public function viewproduct()
    {
    $products1 = ProductsModel::latest()->get();
    $products = ProductsModel::with('category')->get();
    $categories = category::get();
    return view('admincomponents.viewproduct', compact('products','products1','categories')) ;
    }
    
    
}
