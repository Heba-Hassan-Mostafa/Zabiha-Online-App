<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\OptionSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ImageSliderSeeder;
use Database\Seeders\DeliveryTimeSeeder;
use Database\Seeders\NotificationSeeder;
use Database\Seeders\OptionValuesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(CitySeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(OptionValuesSeeder::class);
        $this->call(DeliveryTimeSeeder::class);
        $this->call(CouponSeeder::class);
        $this->call(SettingSeeder::class);
       // $this->call(NotificationSeeder::class);
        $this->call(ImageSliderSeeder::class);

    }
}