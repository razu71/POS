<?php

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = new Order();
        $order->seller_id = 1;
        $order->total_price = 200;
        $order->total_discount = 15;
        $order->given_payment = 200;
        $order->total_quantity = 10;
        $order->payment_type = card;
        $order->return_cash = 0;
    }
}
