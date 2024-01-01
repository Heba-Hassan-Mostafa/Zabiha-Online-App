<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereHas('roles')->orderBy('id', 'desc')->get();
        return view('admin.users-admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get(['id', 'name']);
        return view('admin.users-admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {

        $validated = $request->validated();

        $input['first_name']                = $request->first_name;
        $input['last_name']                 = $request->last_name;
        $input['email']                     = $request->email;
        $input['phone']                     = $request->phone;
        $input['password']                  = bcrypt($request->password);


        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        if ($request->hasFile('image')) {
            if ($image = $request->file('image')) {
                $img = $image->getClientOriginalName();
                $image->storeAs('images/users/', $img, 'upload_images');
            }

            $user->image = $img;
        }

        $user->save();



        $success = [
            'message' => 'تم الاضافة بنجاح',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.users.index')->with($success);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users-admin.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get(['id', 'name']);
        $userRole = $user->roles->pluck('id', 'name')->toArray();
        return view('admin.users-admin.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $validated = $request->validated();

        $user = User::findOrFail($id);

        if ($user) {
            $data['first_name']     = $request->first_name;
            $data['last_name']      = $request->last_name;
            $data['email']          = $request->email;
            $data['phone']         = $request->phone;
            if (trim($request->password) != '') {
                $data['password'] = bcrypt($request->password);
            }

            if ($request->hasFile('image')) {
                if ($image = $request->file('image')) {
                    if ($user->image != '') {
                        if (File::exists('Files/images/users/' . $user->image)) {
                            unlink('Files/images/users/' . $user->image);
                        }
                    }
                    $img = $image->getClientOriginalName();
                    $image->storeAs('images/users/', $img, 'upload_images');
                }

                $user->image = $img;
            }
        }


        $user->update($data);

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        $success = [
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.users.index')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $success = [
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'error'
        ];

        return redirect()->route('admin.users.index')->with($success);
    }

}
