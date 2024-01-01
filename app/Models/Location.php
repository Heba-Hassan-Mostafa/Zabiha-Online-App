<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded= [];
    protected $table  = 'locations';
    public $timestamps = true;

    public function city()
    {
        return $this->belongsTo(City::class);
        
    }

    public function user()
    {
        return $this->belongsTo(User::class);
        
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
        
    }
}
