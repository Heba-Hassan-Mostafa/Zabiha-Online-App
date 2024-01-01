<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\OrderDecrementProductQuantity;

class DecrementProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        foreach(Cart::get() as $item){

            $product = Product::where('id',$item->product_id)
            ->update([
                'store_quantity' => DB::raw('store_quantity -'.$item->quantity)
            ]);

        }
    }
}
