<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = ContactUs::latest()->get();

        return view('admin.contact-us.index',compact('contacts'));

    }

   
    public function destroy(string $id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->delete();

        $success=[
            'message'=>'تم الحذف بنجاح',
            'alert-type'=>'success'
        ];
    
        return redirect()->route('admin.contact-us.index')->with($success);
    }
}
