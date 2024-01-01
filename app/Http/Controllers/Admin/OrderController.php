<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\CancelReason;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Notifications\SendNotification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->has('type')) {
            $orders = Order::with(['user', 'products'])->where('order_status', request()->input('type'))->latest()->get();
        } else {
            $orders = Order::latest()->get();
        }
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with(['user', 'products', 'location', 'coupon'])->findOrFail($id);

        $order_status_array = [
            '0' => 'قيد الانتظار',
            '1' => 'تحت التنفيذ ',
            '2' => 'فى الطريق ',
            '3' => 'منتهى',
            '4' => 'مكتملة الدفع',
            '5' => 'مرفوض',
        ];
        $key = array_search($order->order_status, array_keys($order_status_array));
        foreach ($order_status_array as $k => $v) {
            if ($k <= $key) {
                unset($order_status_array[$k]);
            }
        }
        return view('admin.orders.show', compact('order', 'order_status_array'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        if ($request->order_status == Order::REJECTED) {
            $order->update(['order_status' => Order::REJECTED]);
            app()->call(new SendNotification('reject_order', $order->toArray()));
        } else {
            $order->update(['order_status' => $request->order_status]);
            //dd($order->toArray());
            app()->call(new SendNotification('accept_order', $order->toArray()));
        }
        $success = [
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.orders.index', ['type' => $request->order_status])->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {

        $order->delete();

        $success = [
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.orders.index')->with($success);
    }

    public function cancelOrder(Order $order)
    {
        $orders = CancelReason::with(['user', 'order'])->latest()->get();

        return view('admin.orders.cancel-order', compact('orders'));
    }
}
