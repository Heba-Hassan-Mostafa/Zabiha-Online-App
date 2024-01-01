<?php

namespace App\Http\Controllers\Admin\Products;

use Exception;
use App\Models\City;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Products\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category'])->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::wherestatus(1)->get(['id', 'name']);
        $cities     = City::get(['id', 'name_ar']);

        return view('admin.products.create', compact('categories', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            $validated = $request->validated();


            $data['name']           = $request->name;
            $data['description']    = $request->description;
            $data['main_price']     = $request->main_price;
            $data['discount_price'] = $request->discount_price;
            $data['store_quantity'] = $request->store_quantity;
            $data['status']         = $request->status;
            $data['category_id']    = $request->category_id;
            $data['city_id']        = $request->city_id;


            $product = Product::create($data);

            if ($request->hasFile('image')) {

                if ($image = $request->file('image')) {
                    $img = $image->getClientOriginalName();
                    $image->storeAs('images/products/', $img, 'upload_images');
                }

                $product->image = $img;
            }

            $product->save();

            $success = [
                'message' => 'تم الاضافة بنجاح',
                'alert-type' => 'success'
            ];

            return redirect()->route('admin.products.index')->with($success);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::wherestatus(1)->get(['id', 'name']);
        $cities     = City::get(['id', 'name_ar']);

        return view('admin.products.edit', compact('categories', 'cities', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        try {
            $validated = $request->validated();


            $data['name']           = $request->name;
            $data['description']    = $request->description;
            $data['main_price']     = $request->main_price;
            $data['discount_price'] = $request->discount_price;
            $data['store_quantity'] = $request->store_quantity;
            $data['status']         = $request->status;
            $data['category_id']    = $request->category_id;
            $data['city_id']        = $request->city_id;


            $product = Product::findOrFail($id);
            $product->update($data);


            if ($request->hasFile('image')) {

                if ($image = $request->file('image')) {

                    if (!empty($product->image)) {

                        if (File::exists('Files/images/products/' . $product->image)) {
                            unlink('Files/images/products/' . $product->image);
                        }
                    }
                    $img = $image->getClientOriginalName();
                    $image->storeAs('images/products/', $img, 'upload_images');
                }

                $product->image = $img;
            }

            $product->save();

            $success = [
                'message' => 'تم التعديل بنجاح',
                'alert-type' => 'success'
            ];

            return redirect()->route('admin.products.index')->with($success);
            
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
  
        $success=[
          'message'=>'تم الحذف بنجاح',
          'alert-type'=>'success'
      ];
  
      return redirect()->route('admin.products.index')->with($success);
    }
}
