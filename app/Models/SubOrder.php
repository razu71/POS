<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubOrder extends Model
{
    //
    protected $fillable = [

        'order_id',
        'p_id',
        'discount',
        'discount_type',
        'quantity',
        'price'
    ];
}
