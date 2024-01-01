<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = User::with('city')->doesntHave('roles')->latest()->get();

        return view('admin.clients.index',compact('clients'));
    }

   
    public function destroy(string $id)
    {
        $client = User::findOrFail($id);
        $client->delete();

        $success=[
            'message'=>'تم الحذف بنجاح',
            'alert-type'=>'success'
        ];
    
        return redirect()->route('admin.clients.index')->with($success);
    }
}
