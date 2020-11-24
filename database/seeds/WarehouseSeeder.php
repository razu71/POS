<?php

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warehouse = new Warehouse();
        $warehouse->name = 'Warehouse Bazar';
        $warehouse->save();

        $warehouse = new Warehouse();
        $warehouse->name = 'Mena Bazar';
        $warehouse->save();

        $warehouse = new Warehouse();
        $warehouse->name = 'Jolil Bazar';
        $warehouse->save();

    }
}
