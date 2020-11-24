<?php

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplier = new Supplier();
        $supplier->name = 'Anamul kabir';
        $supplier->image = 'assets/images/product/pro-2.jpg';
        $supplier->email = 'anamul@gmail.com';
        $supplier->mobile = 123456456;
        $supplier->address = 'Khulna';
        $supplier->save();

        $supplier = new Supplier();
        $supplier->name = 'Ratul Khan';
        $supplier->image = 'assets/images/product/pro-2.jpg';
        $supplier->email = 'ratul@gmail.com';
        $supplier->mobile = 123456456;
        $supplier->address = 'Khulna';
        $supplier->save();
    }
}
