<?php

namespace Database\Seeders;

use App\Models\City;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory;use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $cities = collect(City::all()->modelKeys());

        for ($i = 0; $i <10; $i++) {
            User::create([
                'first_name' => $faker->name,
                'last_name' => $faker->name,
                'email' => $faker->email,
                'phone' => '9665' . random_int(10000000, 99999999),
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('123123123'),
                'city_id' =>$cities->random()
            ]);
        }
    }
}
