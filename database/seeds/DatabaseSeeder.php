<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(CouponSeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(LotSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
