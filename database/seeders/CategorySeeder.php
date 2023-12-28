<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = new Category();
        $category->name = "Fiction";
        $category->save();

        $category = new Category();
        $category->name = "Non-Fiction";
        $category->save();
    }
}
