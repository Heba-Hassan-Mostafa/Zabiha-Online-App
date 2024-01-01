<?php 

namespace App\Repositories\Cart;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface CartRepositoryInterface 
{
      //get all products from cart
      public function get() :Collection ;

      //add product to cart
      public function add($request,Product $product , $quantity =1) ;

       //update quantity of product to cart
       public function update($id , $quantity) ;

      //delete products from cart
      public function delete($id) ;
      
      //clear cart
      public function empty() ;

       // cart count
       public function count() ;

      //get total price from cart
      public function Total() :float;

      

}