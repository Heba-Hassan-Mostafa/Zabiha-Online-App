<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ForgotPassword extends Controller
{
   //forgotPassword 

   public function forgotPassword(Request $request)
   {

        $validator = Validator::make($request->all(), [
           'phone' => 'required|numeric',

       ]);
       if($validator->fails()){
           return response()->json($validator->errors()->toJson(), 400);
       }

       $user = User::where('phone',$request->phone)->first();

       if($user){
           $code = '0000';
           $update = $user->update(['code'=> $code]);

           if($update){
               return response()->json([
                   'message' => 'Code Sent successfully,Please check your phone',
                   'code' => $code
               ], 200);
           }else{
               return response()->json([
                   'message' => 'Something wrong,please try again',
               ], 400);
           }
        
       }else{
           return response()->json([
               'message' => 'Something wrong,please try again',
           ], 400);
       }
   }


   //RestPassword

   public function resetPassword(Request $request)
   {

       $validator = Validator::make($request->all(),[

           'code' => 'required',
           'password' => 'required|confirmed|min:6',

       ]);

       if($validator->fails()){
           return response()->json($validator->errors()->toJson(),400);
       }

       $user = User::where('code',$request->code ,function($q){
           $q->where('code','!=',null);
       })->first();

       if($user){
           $user->password = bcrypt($request->password);
           $user->code = null;

           if($user->save()){
               return response()->json([
                   'message' => 'password updated successfully',
               ], 200);
           }else{
               return response()->json([
                   'message' => 'Something wrong,please try again',
               ], 400);
           }
       }else{
           return response()->json([
               'message' => 'Code is invalid ,please try again',
           ], 400);
       }
   }
}
