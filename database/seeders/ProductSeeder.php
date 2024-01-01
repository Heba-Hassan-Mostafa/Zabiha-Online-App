<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

       
        $categories = collect(Category::all()->modelKeys());
        $cities = collect(City::all()->modelKeys());


        Product::create(['name' => 'نعيمى بلدى', 'description'   => $faker->paragraph(),'image'=> 'image.jpg','main_price'=>'150','discount_price'=>'100','store_quantity'=>100, 'status' => 1,'category_id'=> $categories->random(),'city_id'=> $cities->random()]);
        Product::create(['name' => 'حاشى بلدى', 'description'   => $faker->paragraph(), 'image'=> 'image.jpg','main_price'=>'250','discount_price'=>'200','store_quantity'=>500,'status' => 1,'category_id'=> $categories->random(),'city_id'=> $cities->random()]);
        Product::create(['name' => 'تيس بلدى',  'description'   => $faker->paragraph(),'image'=> 'image.jpg','main_price'=>'350','discount_price'=>'300','store_quantity'=>200,'status' => 1,'category_id'=> $categories->random(),'city_id'=> $cities->random()]);
    }
}
