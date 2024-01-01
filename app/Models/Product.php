<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'products';
    public $timestamp = true ;

    public function category()
    {
        return $this->belongsTo(Product::class);

    }
    public function city()
    {
        return $this->belongsTo(City::class);

    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_product','order_id','product_id','id','id')
        ->using(OrderProduct::class)
        ->withPivot(['price','quantity','note','options']);

    }

    public function carts()
    {
        return $this->hasMany(Cart::class);

    }

    public function option_values()
    {
        return $this->belongsToMany(OptionValue::class)->withPivot('option_price');
        
    }

    public function image_sliders()
    {
        return $this->hasMany(ImageSlider::class);
    }

    public function status()
    {
        return $this->status ?   'ظاهر' : 'مخفى' ;
    }
}