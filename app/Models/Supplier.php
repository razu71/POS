<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'image',
        'email',
        'mobile',
        'address',
        'trade_license',
    ];
}
