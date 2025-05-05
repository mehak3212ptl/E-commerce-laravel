<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionAdminController extends Controller
{


    public function index()
    {  
        
   
    return view('subscriptionAdmin.admincomponents.cards') ;
    }


    public function settings()
    {  
    return view('subscriptionAdmin.admincomponents.settings') ;
    }
    
}
