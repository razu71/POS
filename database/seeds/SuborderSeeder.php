<?php

use App\Models\SubOrder;
use Illuminate\Database\Seeder;

class SuborderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suborder = new SubOrder();
        $suborder->order_id = 1;
        $suborder->p_id = 1;
        $suborder->discount = 15;
        $suborder->discount_type = 2;
        $suborder->quantity = 10;
        $suborder->price = 50;
        $suborder->save();
    }
}
