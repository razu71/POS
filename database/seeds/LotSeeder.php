<?php

use App\Models\Lot;
use Illuminate\Database\Seeder;

class LotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lot = new Lot();
        $lot->name = 'Product Lot';
        $lot->warehouse_id = 1;
        $lot->save();
    }
}
