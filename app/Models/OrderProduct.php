<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends Pivot
{
    use HasFactory;
    protected $guarded= [];
    protected $table  = 'order_product';
    public $incrementing = true;

}
