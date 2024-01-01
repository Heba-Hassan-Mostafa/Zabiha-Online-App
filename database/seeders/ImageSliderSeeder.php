<?php

namespace Database\Seeders;

use App\Models\ImageSlider;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = collect(Product::all()->modelKeys());

        ImageSlider::create(['file_name' => 'sheep.jpg', 'product_id' => $products->random() , 'url' => null , 'status' => 1]);
        ImageSlider::create(['file_name' => 'camel.png', 'product_id' => $products->random() ,  'url' => null , 'status' => 1]);
        ImageSlider::create(['file_name' => 'goat.ipg',     'product_id' => $products->random() , 'url' => null , 'status' => 1]);
        ImageSlider::create(['file_name' => 'sheeps.jpg',     'product_id' => $products->random() , 'url' => null , 'status' => 1]);
    }
}
