<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded= [];
    protected $table  = 'coupons';
    public $timestamps = true;
    protected $casts = [ 'valid_from'=>'datetime','valid_to'=>'datetime'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
