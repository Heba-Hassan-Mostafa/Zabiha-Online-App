<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('admin.settings.index', $setting);
    
    }

  
    public function update(Request $request)
    {
        try{
            $info = $request->except('_token', '_method', 'logo');
            foreach ($info as $key=> $value){
                Setting::where('key', $key)->update(['value' => $value]);
            }

            if($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logo_name = $logo->getClientOriginalName();
                Setting::where('key', 'logo')->update(['value' => $logo_name]);

                $logo->storeAs('images/settings/', $logo_name, 'upload_images');
            }

            $success=[
                'message'=>'تم التعديل بنجاح',
                'alert-type'=>'success'
            ];
        
            return redirect()->route('admin.settings.index')->with($success);
        }
        catch (\Exception $e){

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
    
}
