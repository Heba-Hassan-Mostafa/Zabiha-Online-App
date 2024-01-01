<?php

namespace App\Http\Controllers\Admin\Products;

use Exception;
use App\Models\Option;
use App\Models\Category;
use App\Models\OptionValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\OptionRequest;
use App\Http\Requests\Products\CategoryRequest;
use App\Http\Requests\Products\OptionValueRequest;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $options = Option::all();

        return view('admin.options.index',compact('options'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereStatus(1)->get(['id','name']);
        return view('admin.options.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OptionRequest $request)
    {
        try {
            $validated = $request->validated();


            $data['name']          = $request->name;
            $data['input_type']    = $request->input_type;


           $option= Option::create($data);
           $option->categories()->attach($request->categories);

            $success=[
                'message'=>'تم الاضافة بنجاح',
                 'alert-type'=>'success'
            ];

            return redirect()->route('admin.options.index')->with($success);

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

       $option = Option::findOrFail($id);
       $categories = Category::whereStatus(1)->get(['id','name']);

       return view('admin.options.edit',compact('option','categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OptionRequest $request, string $id)
    {

        try {
            $validated = $request->validated();


            $data['name']          = $request->name;
            $data['input_type']    = $request->input_type;

            $option = Option::findOrFail($id);

           $option->update($data);
           $option->categories()->sync($request->categories);

            $success=[
                'message'=>'تم التعديل بنجاح',
                'alert-type'=>'success'
            ];

            return redirect()->route('admin.options.index')->with($success);

        }catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $option = Option::findOrFail($id);
        $option->delete();
  
        $success=[
            'message'=>'تم الحذف بنجاح',
          'alert-type'=>'success'
      ];
  
      return redirect()->route('admin.options.index')->with($success);
    }

}
