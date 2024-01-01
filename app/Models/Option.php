<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $guarded= [];
    protected $table  = 'options';
    public $timestamps = true;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
        
    }

    public function option_values()
    {
        return $this->hasMany(OptionValue::class);
        
    }

  
}
