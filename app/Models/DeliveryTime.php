<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $guarded= [];
    protected $table  = 'delivery_times';
    public $timestamps = true;

    public function orders() 
    {
        return $this->hasMany(Order::class);
        
    }
}
