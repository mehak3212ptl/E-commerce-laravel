<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SpatieUserController extends Controller
{
    public function index(){
        $users=User::get();

        return view('role-permission.user.index',['users'=>$users]);
    }

    public function create(){

        return view('role-permission.user.create');
    }
}
