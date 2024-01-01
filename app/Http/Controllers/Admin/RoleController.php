<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('id','asc')->paginate(10);
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('admin.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(), [
            'name'       => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $role = Role::create(['guard_name' => 'web' ,'name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        $success=[
            'message'=>'تم الاضافة بنجاح',
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.roles.index')->with($success);
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
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('admin.roles.edit',compact('role','permissions','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'       => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->guard_name = 'web';
        $role->save();

        $role->syncPermissions($request->input('permission'));

         $success=[
            'message'=>'تم التعديل بنجاح',
            'alert-type'=>'success'
        ];

        return redirect()->route('admin.roles.index')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::FindOrFail($id)->delete();

        $success=[
            'message'=>'تم الحذف بنجاح',
            'alert-type'=>'error'
        ];

        return redirect()->route('admin.roles.index')->with($success);
    }
    
}
