<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $fillable = [
        'name',
        'image',
        'status'
    ];

    public function getProduct(){
        return $this->hasMany(Product::class);
    }

}
