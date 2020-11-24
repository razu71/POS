<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Warehouse extends Model
{
    protected $fillable = [
        'name',
        'status',
        'slug',
    ];

    public function lots(){
        return $this->hasMany(Lot::class);
    }
}
