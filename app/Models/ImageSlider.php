<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageSlider extends Model
{
    use HasFactory;

    protected $guarded= [];
    protected $table  = 'image_sliders';
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function status()
    {
        return $this->status ?   'ظاهر' : 'مخفى' ;
    }
}
