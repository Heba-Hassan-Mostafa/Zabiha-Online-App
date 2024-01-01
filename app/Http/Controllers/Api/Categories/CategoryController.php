<?php

namespace App\Http\Controllers\Api\Categories;

use App\Models\City;
use App\Models\Option;
use App\Models\Product;
use App\Models\Category;
use App\Models\OptionValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\Categories\OptionResource;
use App\Http\Resources\Api\Categories\ProductResource;
use App\Http\Resources\Api\Categories\CategoryResource;
use App\Http\Resources\Api\Categories\OptionValueResource;
use App\Http\Resources\Api\General\SliderResource;
use App\Models\ImageSlider;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    //get-All-Categories
    public function getAllCategories()
    {

        $categories = CategoryResource::collection(Category::get());

        return $this->apiResponse($categories,'Get all categories',200);
    }

    public function getCategoriesProducts()
    {
        $collection = Category::with('products')->paginate(2);

        $categories = CategoryResource::collection($collection);

        return $this->apiResponse($categories,'Get all options',200);
       
    }

    //get-Category-ById
    public function getCategoryById($id)
    {

        $category = Category::findOrFail($id);
       
        if($category)
        {
            return $this->apiResponse(new CategoryResource($category),'Get category by Id',200);

        }
            return $this->apiResponse(null,'this category not found',404);

    }



    //get-All-Products
    public function getAllProducts()
    {

        $products = ProductResource::collection(Product::get());

        return $this->apiResponse($products,'Get all products',200);
    }

    //get-Product-ById
    public function getProductById($id)
    {

        $product = Product::find($id);
       
        if($product)
        {
            return $this->apiResponse(new ProductResource($product),'Get product by Id => '.$id,200);

        }
            return $this->apiResponse(null,'this product not found',404);

    }

    public function getProductCategory($id)
    {
        $products = Product::with('category')->where('category_id',$id)->paginate(2); 
        $collections = ProductResource::collection($products);

        return $this->apiResponse($collections,'Get Product Category',200);
    }

    // get-all-options
    public function getAllOptions()
    {
        $options = OptionResource::collection(Option::get());

        return $this->apiResponse($options,'Get all options',200);
        
    }

    //get-option-with-values
    public function getOptionWithValue()
    {
        $collection = Option::with('option_values')->get();

        $options = OptionResource::collection($collection);

        return $this->apiResponse($options,'Get all options',200);
        
    }

    //get-values-of-option
    public function getOptionValue($id)
    {
        $values = OptionValue::with('option')->where('option_id',$id)->get(); 
        $optionValues = OptionValueResource::collection($values);

        return $this->apiResponse($optionValues,'Get all option values',200);
    }


    public function search($name)
    {
        $search = Product::where('name', 'LIKE', '%'. $name. '%')->get();

        if(count($search))
        {
            return $this->apiResponse($search,'success', 200);


        }else{
            return $this->apiResponse(null,'Product Not found', 404);
        }
        
    }

    public function imageSlider()
    {
        $images = ImageSlider::with('product')->whereStatus(1)->orderBy('id','desc')->paginate(3);

        return $this->apiResponse(SliderResource::collection($images),'get all image slider', 200);

    }
}
