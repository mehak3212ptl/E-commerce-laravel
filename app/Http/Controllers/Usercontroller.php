<?php

namespace App\Http\Controllers;

use App\Models\hero;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    
public function index()
{
    $activeHeroes = hero::where('status', 1)->get();
    return view('welcome', compact('activeHeroes'));
}
}
