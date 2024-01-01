<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
        
    }
    public function products()
    {
        return $this->hasMany(Product::class);
        
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
        
    }
}
