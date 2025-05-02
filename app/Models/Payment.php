<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'tenant_id',
        'razorpay_payment_id',
        'razorpay_order_id',
        'amount',
        'status',
    ];
}
