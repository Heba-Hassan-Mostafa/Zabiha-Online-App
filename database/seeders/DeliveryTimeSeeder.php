<?php

namespace Database\Seeders;

use App\Models\DeliveryTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryTime::create(['from' => '6ص', 'to' => '12م']);
        DeliveryTime::create(['from' => '12م', 'to' => '6م']);
        DeliveryTime::create(['from' => '6م',   'to' => '12ص']);
    }
}
