<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\DeliveryTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryTimeRequest;

class DeliveryTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $times = DeliveryTime::get();
        return view('admin.delivery-time.index',compact('times'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.delivery-time.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryTimeRequest $request)
    {
        try {
            $validated = $request->validated();


            $data['from']        = $request->from;
            $data['to']          = $request->to;
            
           DeliveryTime::create($data);

            $success=[
                'message'=>'تم الاضافة بنجاح',
                'alert-type'=>'success'
            ];

            return redirect()->route('admin.delivery-time.index')->with($success);

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
        $time = DeliveryTime::findOrFail($id);
            return view('admin.delivery-time.edit',compact('time'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeliveryTimeRequest $request, string $id)
    {
        try {
            $validated = $request->validated();


            $data['from']        = $request->from;
            $data['to']          = $request->to;
            
           $time = DeliveryTime::findOrFail($id);
           $time->update($data);

            $success=[
                'message'=>'تم التعديل بنجاح',
                'alert-type'=>'success'
            ];

            return redirect()->route('admin.delivery-time.index')->with($success);

        }catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $time = DeliveryTime::findOrFail($id);
        $time->delete();

        $success=[
            'message'=>'تم الحذف بنجاح',
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.delivery-time.index')->with($success);
    }
}
