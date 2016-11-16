<?php

use Illuminate\Database\Seeder;
use App\Category;
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
        $category->name = 'Outdoors';
        $category->save();
        
        $category = new Category();
        $category->name = 'Sports';
        $category->save();

        $category = new Category();
        $category->name = 'Gaming';
        $category->save();

        $category = new Category();
        $category->name = 'Music';
        $category->save();

        $category = new Category();
        $category->name = 'Movies';
        $category->save();

        $category = new Category();
        $category->name = 'Food';
        $category->save();
        
        $category = new Category();
        $category->name = 'Programming';
        $category->save();

        $category = new Category();
        $category->name = 'Politics';
        $category->save();

        $category = new Category();
        $category->name = 'Environment';
        $category->save();

        $category = new Category();
        $category->name = 'Health';
        $category->save();

        $category = new Category();
        $category->name = 'Art';
        $category->save();

        $category = new Category();
        $category->name = 'Business';
        $category->save();
    }
}
