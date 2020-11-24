<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->title = 'Testing Product';
        $product->category_id = 1;
        $product->brand_id = 1;
        $product->price = 190;
        $product->discount_percent = 0;
        $product->discount_price = 15;
        $product->discount_type = DISCOUNT_TYPE_FLAT;
        $product->qty = 1;
        $product->sku = '12131';
        $product->image = 'assets/images/product/pro-2.jpg';
//        $product->barcode = 'N1k23N';
        $product->total_sell = 5;
        $product->availability = 0;
        $product->supplier_id = 1;
        $product->stockable = 10;
        $product->description = 'This is the test product for this project!';
        $product->save();
    }
}
