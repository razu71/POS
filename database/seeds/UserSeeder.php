<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'username' => 'Mr. Admin',
                'email' => 'admin@pos.com',
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'role' => USER_ROLE_ADMIN,
                'country_id' => '88',
                'national_id' => '',
            ]
        );
    }
}
