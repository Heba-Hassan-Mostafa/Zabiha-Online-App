<?php 

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Setting;
use App\Models\OptionValue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class CartRepository implements CartRepositoryInterface 
{ 
      protected $items;

      public function __construct()
      {
            $this->items = collect([]);
      }
      public function get() : Collection 
      {
            if(!$this->items->count())
            {
                  $this->items = Cart::with(['product','user'])->where('user_id',Auth::id())->get();
            }
            return $this->items; 
      }

      public function add($request ,Product $product, $quantity =1) 
      {
          try{
            $item = Cart::where('product_id',$product->id)
                        ->where('user_id',auth()->id())->first();
            if(!$item)
            {
                 $cart = Cart::create([
                        'user_id'    => auth()->id(),
                        'product_id' => $product->id,
                        'quantity'   => $quantity,
                        'price'      => $product->discount_price == Null ? $product->main_price : $product->discount_price,
                        'options'    => json_encode($request->options),
                    ]);

                    $this->get()->push($cart);
                    return $cart;
            }
                return  $item->increment('quantity', $quantity);
            
            
          
            }
            catch (\Exception $e)
            {
                  return response()->json(['error' => $e->getMessage()], 422);
            }
            
      }

      public function update($id, $quantity) 
      {
            $cart =  Cart::where('user_id',auth()->id())->where('id',$id)->findOrFail($id);
          
                 if($cart){

                  $cart->update([
                        'quantity' => $quantity
                  ]);
                 }
                  
            
            
            
      }

      public function delete($id) 
      {
            Cart::where('user_id',auth()->id())->where('product_id',$id)->delete();  
      }

      public function empty()
      {
            Cart::where('user_id',auth()->id())->delete();
      }

      public function count()
      {
           return $this->get()->count() ? $this->get()->count() : 0;
      }

      public function total() :float
      {
            // return Cart::where('user_id',auth()->id())
            // ->join('products','products.id', '=' ,'carts.product_id')
            // ->selectRaw('SUM(products.main_price * carts.quantity) as total')
            // ->value('total');
            
            return $this->get()->sum(function($item){

                  $options = OptionValue::whereIn('id',json_decode($item->options,true))->sum('price');
                  $value_added = Setting::where('key', 'value_added')->first()->value;

                   return $item->product->discount_price == Null ? 
                  ($options +  $item->product->main_price + $value_added/100) * $item->quantity  :
                  ($options + $item->product->discount_price + $value_added/100) * $item->quantity ;
                  
            });
            
      }

}
