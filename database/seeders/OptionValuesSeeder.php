<?php

namespace Database\Seeders;

use App\Models\OptionValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OptionValue::create(['option_id' => 1,'value' => 'نعيمى هرفى صفير (10-20ك)','price'=> 800]);
        OptionValue::create(['option_id' => 1,'value' => 'نعيمى هرفى كبير (100-200ك)','price'=> 800]);
        OptionValue::create(['option_id' => 2,'value' => 'تقطيع تلاجة','price'=> null]);
        OptionValue::create(['option_id' => 3,'value' => 'ممتاز','price'=> 800]);
    }
}
