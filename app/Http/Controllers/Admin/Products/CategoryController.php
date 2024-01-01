<?php

namespace App\Http\Controllers\Admin\Products;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Products\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();

        return view('admin.categories.index',compact('categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $validated = $request->validated();


            $data['name']      = $request->name;
            $data['status']    = $request->status;

            
            $category =Category::create($data);

            if($request->hasFile('image'))
            {
                if($image = $request->file('image'))
                {
                    $img = $image->getClientOriginalName();
                    $image->storeAs('images/categories/', $img , 'upload_images');
    
    
                }
    
                $category->image = $img;
            }
    
            $category->save();

            $success=[
                'message'=>'تم الاضافة بنجاح',
                'alert-type'=>'success'
            ];

            return redirect()->route('admin.categories.index')->with($success);

        }catch (Exception $e) {
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
       $category = Category::findOrFail($id);
       return view('admin.categories.edit',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        try {

            $validated = $request->validated();


            $data['name']      = $request->name;
            $data['status']    = $request->status;

            
            $category = Category::findOrFail($id);

            $category->update($data);

            if($request->hasFile('image'))
            {
                if($image = $request->file('image'))
                {
                    if (!empty($category->image)) {

                        if (File::exists('Files/images/categories/'.$category->image)) {
                            unlink('Files/images/categories/'. $category->image);
                        }
                    }
                    $img = $image->getClientOriginalName();
                    $image->storeAs('images/categories/', $img , 'upload_images');
    
    
                }
    
                $category->image = $img;
            }
    
            $category->save();

            $success=[
                'message'=>'تم التعديل بنجاح',
                'alert-type'=>'success'
            ];

            return redirect()->route('admin.categories.index')->with($success);

        }catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $category = Category::findOrFail($id);
      $category->delete();

      $success=[
        'message'=>'تم الحذف بنجاح',
        'alert-type'=>'success'
    ];

    return redirect()->route('admin.categories.index')->with($success);
    }
}
