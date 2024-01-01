<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValueProduct extends Model
{
    use HasFactory;

    protected $guarded= [];
    protected $table  = 'option_value_product';
    public $timestamps = true;
}
