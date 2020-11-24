<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->slug = 'title';
        $admin->value = 'POS';
        $admin->save();

        $admin = new Admin();
        $admin->slug = 'image';
        $admin->value = 'POS.jpg';
        $admin->save();

        $admin = new Admin();
        $admin->slug = 'favicon';
        $admin->value = 'favicon.jpg';
        $admin->save();

        $admin = new Admin();
        $admin->slug = 'footer';
        $admin->value = 'ItechSoftSolutions';
        $admin->save();

        $admin = new Admin();
        $admin->slug = 'vat';
        $admin->value = 10;
        $admin->save();

        $admin = new Admin();
        $admin->slug = 'discount';
        $admin->value = 20;
        $admin->save();

        $admin = new Admin();
        $admin->slug = 'login_image';
        $admin->value = 'image.jpg';
        $admin->save();

        $admin = new Admin();
        $admin->slug = 'captcha';
        $admin->value = 2;
        $admin->save();

        $admin = new Admin();
        $admin->slug = 'captcha_key';
        $admin->value = '';
        $admin->save();

        $admin = new Admin();
        $admin->slug = 'captcha_site_key';
        $admin->value = '';
        $admin->save();

        Admin::create(['slug' => 'currency', 'value' => 'USD']);

    }
}
