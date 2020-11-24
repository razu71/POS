<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->parent_id = 1;
        $category->title = 'Shirt';
        $category->image = 'assets/images/product/pro-2.jpg';
        $category->status = 1;
        $category->save();

        $category = new Category();
        $category->parent_id = 2;
        $category->title = 'Pant';
        $category->image = 'assets/images/product/pro-2.jpg';
        $category->status = 0;
        $category->save();
    }
}
