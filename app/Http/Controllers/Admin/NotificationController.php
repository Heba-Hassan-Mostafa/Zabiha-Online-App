<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.notifications.index',['data'=>auth()->user()->notifications]);
    }

    public function markAsRead(string $id){
        auth()->user()->unreadNotifications()->where('id',$id)->first()->markAsRead();
        $success=[
            'message'=>'تم التعديل بنجاح',
            'alert-type'=>'success'
        ];
    
        return redirect()->route('admin.notifications.index')->with($success);
    }
    public function destroy(string $id)
    {
       $data = auth()->user()->notifications()->findOrFail($id);
       $data->delete();
        $success=[
            'message'=>'تم الحذف بنجاح',
            'alert-type'=>'success'
        ];
    
        return redirect()->route('admin.notifications.index')->with($success);
    }
}
