<?php

namespace App\Models;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{    

    protected $guarded=[];
    protected $table='plans';


            public function features()
        {
            return $this->hasMany(Feature::class);
        }
}
