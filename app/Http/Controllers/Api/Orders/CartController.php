<?php

namespace App\Http\Controllers\Api\Orders;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Api\Orders\CartResource;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Repositories\Cart\CartRepositoryInterface;

class CartController extends Controller
{ 
    protected $cart;

    public function __construct(CartRepositoryInterface $cart)
    {
        $this->cart = $cart;

    }
    use ApiResponseTrait;

    public function getCartItems()
    {
        $cart =CartResource::collection($this->cart->get());
       return $this->apiResponse($cart,'All Cart Products ',200);

    }
    public function addToCart(Request $request)
     {
        $validator = Validator::make($request->all(), [
                    'product_id' => 'required|exists:products,id',
                    'quantity' => 'required|min:1',
                    'options' => 'required|array',
        
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }
                $product = Product::findOrFail($request->post('product_id'));
               $cart = $this->cart->add($request,$product,$request->post('quantity'));

            return $this->apiResponse(null ,'Product Added Successfully To Cart',201);
     }

    public function updateCartItem(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'quantity'                => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $this->cart->update($id,$request->post('quantity'));

        return $this->apiResponse(null,'Product Updated Successfully',200);
    }

    public function deleteProductFromCart($id)
    {
        $this->cart->delete($id);

        return $this->apiResponse(null, 'Product Deleted Successfully From Cart', 200);
    }

    public function deleteAllCartItems(Request $request)
    {
        $this->cart->empty();

        return $this->apiResponse(null,' All Products Deleted Successfully From Cart',200);
    }

    public function CartCount(Request $request)
    {
       $count = $this->cart->count();

        return $this->apiResponse($count,'Count Of Cart',200);
    }
}

