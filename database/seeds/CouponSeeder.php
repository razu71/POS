<?php

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupon = new Coupon();
        $coupon->coupon_number = 'ak121aed';
        $coupon->save();
    }
}
