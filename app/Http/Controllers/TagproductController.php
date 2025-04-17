<?php

namespace App\Http\Controllers;
use App\Models\tag;
use App\Models\tagproduct;
use Illuminate\Http\Request;

class TagproductController extends Controller
{
    public function add_tagproduct(){
        $tagproduct=new tagproduct();
        $tagproduct->name='liners';
        $tagproduct->save();
    
        $tagproductids=[1,2];
        $tagproduct->tags()->attach($tagproductids);
    }
     public function show_tagproduct($id){
        $tagproduct= tag::find($id)->tagproducts;
        return $tagproduct;
     }
}
