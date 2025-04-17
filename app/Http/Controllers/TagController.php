<?php

namespace App\Http\Controllers;
use App\Models\tagproduct;
use App\Models\tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function add_tags(){
        $tag=new  tag();
        $tag->tag='Derma co';
        $tag->save();
    }

    public function show_tags($id){

      $tag=tagproduct::find($id)->tags;
      return $tag;
    }
}
