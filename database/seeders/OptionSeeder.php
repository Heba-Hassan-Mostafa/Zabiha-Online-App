<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Option::create(['name' => 'حجم الذبيحة', 'input_type' => 'single_selection']);
        Option::create(['name' => 'نوع الذبيحة', 'input_type' => 'single_selection']);
        Option::create(['name' => 'التقطيع',     'input_type' => 'single_selection']);
        Option::create(['name' => 'التغليف',     'input_type' => 'single_selection']);
    }
}
