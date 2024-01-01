<?php

namespace Database\Seeders;

use App\Models\Notification;
use Faker\Factory;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();


        $users = collect(User::all()->modelKeys());
        //$orders = collect(Order::all()->modelKeys());

        Notification::create(['user_id'=>$users->random(),'order_id'=> 1,'title' => ' الطلب قيد التنفيذ', 'body'=>' الطلب قيد التنفيذ','url'=>null ,'tokens'=>'test']);
        Notification::create(['user_id'=>$users->random(),'order_id'=> 1,'title' => ' تم استلام الطلب ', 'body'=>' تم استلام الطلب ','url'=>null ,'tokens'=>'test']);
        Notification::create(['user_id'=>$users->random(),'order_id'=> 1,'title' => ' الطلب فى الطريق لك', 'body'=>' الطلب فى الطريق لك','url'=>null ,'tokens'=>'test']);
    }
}
