<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::create(['name' => 'code1','discount' =>'10', 'type' => 'fixed' ,'max_users'=>15 ,'valid_from'=>'2023-7-20','valid_to'=>'2023-7-30']);
        Coupon::create(['name' => 'code2','discount' =>'20', 'type' => 'percentage' ,'max_users'=>15 ,'valid_from'=>'2023-7-20','valid_to'=>'2023-7-30']);
        Coupon::create(['name' => ' code3','discount' =>'30', 'type' => 'fixed' ,'max_users'=>15 ,'valid_from'=>'2023-7-20','valid_to'=>'2023-7-30']);
    }
}
