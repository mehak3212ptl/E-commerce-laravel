<?php

namespace App\Models;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    protected $guarded=[];
    protected $table='features';

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
