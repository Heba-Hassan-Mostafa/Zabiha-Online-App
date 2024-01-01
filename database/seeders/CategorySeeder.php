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
        Category::create(['name' => 'نعيمى بلدى','image' =>'sheep.jpg', 'status' => 1]);
        Category::create(['name' => 'حاشى بلدى','image' =>'camel.jpg', 'status' => 1]);
        Category::create(['name' => 'تيس بلدى','image' =>'goats.jpg', 'status' => 1]);
    }
}
