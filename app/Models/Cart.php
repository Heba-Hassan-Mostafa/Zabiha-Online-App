<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table  = 'carts';
    public $timestamps = true;

    protected $casts = [
        'options' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public function product()
    {
        return $this->belongsTo(Product::class);

    }
    public function getOptionsAttribute($value){
        return json_decode($value,true);
    }

}