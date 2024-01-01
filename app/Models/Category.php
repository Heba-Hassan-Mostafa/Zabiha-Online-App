<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded= [];
    protected $table  = 'categories';
    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(Product::class);
        
    }

    public function options()
    {
        return $this->belongsToMany(Option::class);
        
    }
    public function status()
    {
        return $this->status ?   'ظاهر' : 'مخفى' ;
    }
    
}
