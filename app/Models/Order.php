<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'seller_id',
        'total_price',
        'total_discount',
        'total_quantity'

    ];
}
