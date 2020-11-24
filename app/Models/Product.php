<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'image',
        'category_id',
        'brand_id',
        'price',
        'discount_percent',
        'discount_price',
        'discount_type',
//        'barcode',
        'qty',
        'sku',
        'status',
        'total_sell',
        'supplier_id',
        'availability',
        'stockable',
        'description',
    ];
    public function getCategory(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function getBrand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }



}
