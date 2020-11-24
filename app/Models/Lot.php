<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    protected $fillable = [
        'name',
        'status',
        'cascade',
        'warehouse_id'

    ];

    public function warehouse(){
        return $this->belongsTo(Warehouse::class,'warehouse_id');
    }
}
