<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function  subscription(){
        $plan=Plan::with('features')->get();    

        return view ('subscription',compact('plan'));
    }
}
