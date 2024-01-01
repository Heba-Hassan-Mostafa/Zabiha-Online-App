<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderReview;
use Illuminate\Http\Request;

class ClientReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = OrderReview::with(['user','order'])->get();

        return view('admin.client-reviews.index',compact('reviews'));
        
    }

    
    public function destroy(string $id)
    {
        $client = OrderReview::findOrFail($id);
        $client->delete();

        $success=[
            'message'=>'تم الحذف بنجاح',
            'alert-type'=>'success'
        ];
    
        return redirect()->route('admin.client-reviews.index')->with($success);
    }
}
