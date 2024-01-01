<?php

namespace App\Http\Controllers\Api\General;

use App\Models\City;
use App\Models\User;
use App\Models\Setting;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Notifications\SendNotification;
use App\Http\Resources\Api\General\CityResource;
use App\Http\Resources\Api\General\UserResource;
use App\Http\Resources\Api\General\SettingResource;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\General\ContactUsResource;
use App\Http\Resources\Api\General\CityShippingCostResource;

class GeneralController extends Controller
{
    use ApiResponseTrait;
    
    public function getAllUsers()
    {
      $users = UserResource::collection(User::with('city')->get());

        return $this->apiResponse($users,'Get all Users',200);
        
    }


    public function getAllCities()
    {
      $cities = CityResource::collection(City::get());

        return $this->apiResponse($cities,'Get all Cities',200);
        
    }


 public function getCitiesWithShoppingCost()
    {
      $cost = City::where('shipping_cost','!=',null)->get();
      $cities = CityShippingCostResource::collection($cost);

        return $this->apiResponse($cities,'Get all Cities With Shipping Cost',200);
        
    }


    public function setting()
    {
      $setting = Setting::get();

        return $this->apiResponse(SettingResource::collection($setting),'Get all settings',200);
        
    }

     public function contact_us(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name'     => 'required',
        'phone'    => 'required',
        'message'  => 'required',

    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    $contact = ContactUs::create([

        'name'     => $request->name,
        'phone'    => $request->phone,
        'message'  =>$request->message

    ]);
    
    app()->call(new SendNotification('contact_us', $contact->toArray()));


        return $this->apiResponse( new ContactUsResource($contact),'your message created successfully',200);
        
    }

    public function changeLanguage(Request $request) 
    {

       app()->setLocale('ar');

      if(isset($request->lang) && $request->lang == 'en')
      {
          app()->setLocale('en');
          return $this->apiResponse( null,'Language Updated Successfully To En',200);
      }else{

          app()->setLocale('ar');
          return $this->apiResponse( null,'Language Updated Successfully To Ar',200);

      }
      
    }

    public function deleteAccount()
    {
      $user = auth('api')->user();
    
       $user->update(['device_token' => null]);

       auth('api')->invalidate(true);
       
        $user->delete();

        return $this->apiResponse( null,'User Deleted Successfully',200);
     
      
      
    }
    
}
