<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductsModel;

class category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = ['categoryname'];

    public function  products(){
        return $this->hasMany(ProductsModel::class,'category_id');
    }
}
