<?php

namespace App\Models;

use App\Models\tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tagproduct extends Model
{
    use HasFactory;
    public function tags(){
        return $this->belongsToMany(tag::class,'product_tags');
    }
}
