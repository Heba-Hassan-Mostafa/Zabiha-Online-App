<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Product;
use App\Models\ImageSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = ImageSlider::with('product')->get();
        return view('admin.slider.index',compact('sliders'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::whereStatus(1)->get(['id','name']);
        return view('admin.slider.create',compact('products'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        try {
            $validated = $request->validated();


            $slider         = new ImageSlider;
            $slider->url    = $request->input('url');
            $slider->status = $request->input('status');
            $slider->product_id = $request->input('product_id');

            //upload image
            if($request->hasFile('file_name'))
            {
                if($image = $request->file('file_name'))
                {
                    $img = $image->getClientOriginalName();
                    $image->storeAs('images/slider/', $img , 'upload_images');
                }
    
                $slider->file_name = $img;
            }
    
            $slider->save();
       


            $success=[
                'message'=>'تم الاضافة بنجاح',
                'alert-type'=>'success'
            ];

            return redirect()->route('admin.slider.index')->with($success);

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
        $slider = ImageSlider::findOrFail($id);
        $products = Product::whereStatus(1)->get(['id','name']);
        return view('admin.slider.edit',compact('products','slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, string $id)
    {
        try {
            $validated = $request->validated();


            $slider = ImageSlider::findOrFail($id);

            $data['url']                  = $request->url;
            $data['status']               = $request->status;
            $data['product_id']           = $request->product_id;

    
                $slider->update($data);
    
               // dd($slider);
               
        
                if($request->hasFile('file_name'))
                {
                    if($image = $request->file('file_name'))
                    {
                        if (!empty($slider->file_name)) {
    
                            if (File::exists('Files/images/slider/'.$slider->file_name)) {
                                unlink('Files/images/slider/'. $slider->file_name);
                            }
                        }
                        $img = $image->getClientOriginalName();
                        $image->storeAs('images/slider/', $img , 'upload_images');
                    }
        
                    $slider->file_name = $img;
                }
        
                $slider->save();
           

            $success=[
                'message'=>'تم التعديل بنجاح',
                'alert-type'=>'success'
            ];

            return redirect()->route('admin.slider.index')->with($success);

        }catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = ImageSlider::findOrFail($id);
        $slider->delete();
  
        $success=[
          'message'=>'تم الحذف بنجاح',
          'alert-type'=>'success'
      ];
  
      return redirect()->route('admin.slider.index')->with($success);
    }
}
