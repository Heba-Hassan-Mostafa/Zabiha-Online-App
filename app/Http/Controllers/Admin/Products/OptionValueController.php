<?php

namespace App\Http\Controllers\Admin\Products;

use Exception;
use App\Models\OptionValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\OptionValueRequest;
use App\Models\Option;

class OptionValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OptionValueRequest $request)
    {
       
        try {
            $validated = $request->validated();


            $data['value']      = $request->value;
            $data['price']      = $request->price;
            $data['option_id']  = $request->option_id;
            
            OptionValue::create($data);

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
        $value = OptionValue::findOrFail($id);
        $options = Option::get(['id','name']);
        return view('admin.options.optionValueEdit',compact('value','options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OptionValueRequest $request, string $id)
    {
        try {
            $validated = $request->validated();


            $data['value']      = $request->value;
            $data['price']      = $request->price;
            $data['option_id']  = $request->option_id;
            
           $value = OptionValue::findOrFail($id);

           $value->update($data);

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
        OptionValue::findOrFail($id)->delete();

        $success=[
          'message'=>'تم الحذف بنجاح',
          'alert-type'=>'success'
      ];
  
      return redirect()->route('admin.options.index')->with($success);
    }
}
