<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    use HasFactory;
    protected $guarded= [];
    protected $table  = 'option_values';
    public $timestamps = true;

    public function option()
    {
        return $this->belongsTo(Option::class);
        
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('option_price');
        
    }
}
