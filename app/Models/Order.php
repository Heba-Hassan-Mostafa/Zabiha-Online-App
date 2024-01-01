<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded= [];
    protected $table  = 'orders';
    public $timestamps = true;


    const PENDING = 0;
    const IN_PROCESS = 1;
    const UNDER_WAY = 2;
    const COMPLETED = 3;
    const PAYMENT_COMPLETED = 4;
    const REJECTED = 5;
    const CANCELED = 6;

    public function products()
    {
        return $this->belongsToMany(Product::class,'order_product','order_id','product_id','id','id')
        ->using(OrderProduct::class)
        ->withPivot(['price','quantity','note','options']);

    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function delivery_time()
    {
        return $this->belongsTo(DeliveryTime::class);
    }

    public function cancel_reasons()
    {
        return $this->hasMany(CancelReason::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);

    }

    public static function booted()
    {
        static::creating(function(Order $order){

            $order->order_number = Order::getNextOrderNumber();
        });
    }
    public function orderReviews()
    {
        return $this->hasMany(OrderReview::class);

    }

    public static function getNextOrderNumber()
    {
        $year = Carbon::now()->year;
        $order_number = Order::whereYear('created_at',$year)->max('order_number');

        if($order_number)
        {
            return $order_number + 1;
        }
        return $year.'0001';
    }


    public function statusWithLabel()
    {
        switch ($this->order_status) {
            case 0: $result = '<label class="btn btn-primary pe-none"> قيد الانتظار </label>'; break;
            case 1: $result = '<label class="btn btn-warning pe-none">تحت التنفيذ</label>'; break;
            case 2: $result = '<label class="btn btn-info pe-none">فى الطريق</label>'; break;
            case 3: $result = '<label class="btn btn-success pe-none">منتهى</label>'; break;
            case 4: $result = '<label class="btn btn-success pe-none"> مكتملة الدفع</label>'; break;
            case 5: $result = '<label class="btn btn-danger pe-none">مرفوض</label>'; break;
            case 6: $result = '<label class="btn btn-danger pe-none">ملغى</label>'; break;
        }
        return $result;
    }
}