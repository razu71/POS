<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lot = new Role();
        $lot->title = 'Admin';
        $lot->description = 'Admin';
        $lot->tasks = '|'.implode('|',array_keys(actions())).'|';
        $lot->save();

    }
}
