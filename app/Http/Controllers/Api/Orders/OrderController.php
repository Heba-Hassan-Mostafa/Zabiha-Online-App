<?php

namespace App\Http\Controllers\Api\Orders;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Location;
use App\Models\OrderReview;
use App\Models\CancelReason;
use App\Models\DeliveryTime;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Cart\CartRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Helpers\Notifications\SendNotification;
use App\Http\Resources\Api\Orders\CouponResource;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\Orders\OrderDetailResource;
use App\Http\Resources\Api\Orders\OrderReviewResource;
use App\Http\Resources\Api\Orders\DeliveryTimeResource;
use App\Http\Resources\Api\Orders\NotificationResource;


class OrderController extends Controller
{
    use ApiResponseTrait;
    public function createOrder(Request $request , CartRepository $cart)
    {

    DB::beginTransaction();

        try{
        $validator = Validator::make($request->all(), [

            'delivery_date'         => 'required',
            'delivery_time_id'      =>'required',
            'delivery_type'         =>'required',
            'note'                  =>'sometimes|nullable',
            'address'               =>'required',
            'long'                  =>'nullable',
            'lat'                   =>'nullable',
            'coupon_id'             =>'nullable'
        ]);

        if ($validator->fails()) 
        {
            return response()->json($validator->errors(), 422);
        }

     $location = Location::create([
        
            'user_id'  => Auth::id(),
            'city_id'  => $request->city_id,
            'address'  => $request->address,
            'long'     => $request->long,
            'lat'      => $request->lat,
        ]);
       if($cart->count() != 0){

       
        $order = Order::create([

            'user_id'           => Auth::id(),
            'subtotal'          => $cart->total(),
            'delivery_date'     => $request->delivery_date,
            'delivery_time_id'  => $request->delivery_time_id,
            'delivery_type'     => $request->delivery_type,
            'note'              => $request->note,
            'location_id'       => $location->id,
            'coupon_id'         => $request->coupon_id,

        ]);

        foreach($cart->get() as $item)
            {
                OrderProduct::create([

                    'order_id'    => $order->id,
                    'product_id'  => $item->product_id,
                    'price'       => $item->product->discount_price == null ? $item->product->main_price :$item->product->discount_price,
                    'quantity'    =>  $item->quantity, 
                    'note'        => $request->note,
                    'options'     => $item->options
                ]);
            }

           $cityId = $order->location->city_id;

           $city = City::where('id',$cityId,function($q){

                $q->where('shipping_cost','!=',null)
                ->orWhere('shipping_cost','!=',0);

           })->first();

            if($city)
            {
                $total = $cart->total() + $city->shipping_cost;
            }else
                {
                $total = $cart->total();
                }

            //apply coupon
            if($request->has('coupon_id'))
            {
                $coupon = Coupon::where('id',$request->coupon_id)
                ->where('valid_to', '>=', Carbon::now())
                ->where('max_users', '!=', 0)->first();

                //dd($coupon);
                if($coupon)
                {

                if($coupon->type == 'fixed'){

                    $total -= $coupon->discount;
                }else{

                    $total -=  $coupon->discount/100;
                }
                }
            }
         

            $order->update([
                'total' => $total
            ]);

            //dd($order->toArray());
            app()->call(new SendNotification('new_order', $order->toArray()));


        }else{
            return $this->apiResponse(null,'Can\'t make order Cart is Empty',200);

        }
       
        
            $cart->empty();
            
           
            DB::commit();
        }
        catch (\Exception $e)
        {
            DB::rollBack();
             return response()->json(['error' => $e->getMessage()], 422);
        }

        return $this->apiResponse(null,'order created succesfully',200);


    }
    public function checkCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name'                  => 'required',
        ]);

       
        if ($validator->fails()) 
        {
            return response()->json($validator->errors(), 422);
        }

        $coupon = Coupon::where('name',$request->name)
                ->where('valid_to', '>=', Carbon::now())
                ->where('max_users', '!=', 0)->first();

        if(!$coupon)
        {
            return $this->apiResponse(null,'your coupon isn\'t valid',422);

        }

        return $this->apiResponse(new CouponResource($coupon),'coupon is valid',200);


    }


    public function deliveryTime()
    {
        $time = DeliveryTime::get();


        return $this->apiResponse(DeliveryTimeResource::collection($time),'Get Delivery Time For Orders',200);


    }
    public function orderDetails($id)
    {
        $order = Order::with(['user','products','location','delivery_time'])->findOrFail($id);

        $details = new OrderDetailResource($order);

        return $this->apiResponse($details,'Get Order Details',200);

    }

    public function CancelOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'order_id'                => 'required',
            'reason'                  =>'required',
           
        ]);

        if ($validator->fails()) 
        {
            return response()->json($validator->errors(), 422);
        }

        $order = Order::with(['user','products'])->find($request->order_id);
        
        if(!$order)
        {
            return $this->apiResponse(null,'order Not Found',404);
        }

       $reason = CancelReason::create([

            'user_id'           => Auth::id(),
            'order_id'          => $request->order_id,
            'reason'            =>$request->reason
        ]);

        $order->update([
            'order_status' => 6
        ]);
        
        app()->call(new SendNotification('cancel_order', $order->toArray()));

        return $this->apiResponse(null,'order Canceled',200);


    }
    

    public function currentOrders()
    {
       $orders = Order::with(['user','products'])->where('user_id',auth()->id())
       ->where('order_status',0)->latest()->paginate(5);

        return $this->apiResponse($orders,'Get Current Order',200);


    }

    public function completedOrders()
    {
       $orders = Order::with(['user','products'])->where('user_id',auth()->id())
       ->where('order_status',4)->latest()->paginate(5);

        return $this->apiResponse($orders,'Get Completed Order',200);


    }


    public function orderReview(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'order_id'              =>'required|exists:orders,id',
            'rate'                  =>'required',
            'comment'               =>'sometimes|nullable',
        ]);

        if ($validator->fails()) 
        {
            return response()->json($validator->errors(), 422);
        }

        $userOrdersCount = $request->user()->orders()
        ->where('order_status', 'completed')
        ->count();

       
        if($userOrdersCount == 0)
        {
            return $this->apiResponse(null,'you Cant\'t make review after delivered order ',200);

        }
        if($userOrdersCount > 0)
        {

            $review  = OrderReview::create([

                'user_id'           => Auth::id(),
                'order_id'          => $request->order_id,
                'rate'              => $request->rate,
                'comment'           => $request->comment,
            ]);
            return $this->apiResponse(new OrderReviewResource($review),'Thank you, Your Review Craeted Successfully!',200);
        }
    }


    public function getAllNotifications()
    {
        $list = auth()->user()->notifications()->orderBy('id','desc')->paginate(10);
        return $this->apiResponse( NotificationResource::collection($list),'get all notifications',200);

    }

    public function notificationCount()
    {
      // dd(auth()->user()->unreadNotifications->count());
        $count = auth()->user()->unreadNotifications->count();
        return $this->apiResponse( $count,'notifications count',200);

    }
}
