<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::get();
        return view('admin.coupons.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        try {
            $validated = $request->validated();


            $data['name']        = $request->name;
            $data['discount']    = $request->discount;
            $data['type']        = $request->type;
            $data['max_users']   = $request->max_users;
            $data['valid_from']  = $request->valid_from;
            $data['valid_to']    = $request->valid_to;
            
           Coupon::create($data);

            $success=[
                'message'=>'تم الاضافة بنجاح',
                'alert-type'=>'success'
            ];

            return redirect()->route('admin.coupons.index')->with($success);

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
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, string $id)
    {
         try {
            $validated = $request->validated();


            $data['name']        = $request->name;
            $data['discount']    = $request->discount;
            $data['type']        = $request->type;
            $data['max_users']   = $request->max_users;
            $data['valid_from']  = $request->valid_from;
            $data['valid_to']    = $request->valid_to;
            
           $coupon = Coupon::findOrFail($id);
           $coupon->update($data);

            $success=[
                'message'=>'تم التعديل بنجاح',
                'alert-type'=>'success'
            ];

            return redirect()->route('admin.coupons.index')->with($success);
            
        }catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
      $coupon->delete();

      $success=[
        'message'=>'تم الحذف بنجاح',
        'alert-type'=>'success'
    ];

    return redirect()->route('admin.coupons.index')->with($success);
    }
}
