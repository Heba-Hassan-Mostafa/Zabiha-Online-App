<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    //Login
    public function login(Request $request){

    	$validator = Validator::make($request->all(), [
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }


    //Register
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'city_id' => 'required',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


    //Logout
    public function logout() {
        auth('api')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }


    //Refresh Token
    public function refresh() {
        return $this->createNewToken(auth('api')->refresh());
    }

    //user profile
    public function userProfile() {
        return response()->json(auth('api')->user());
    }

    // update profile

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|numeric|unique:users',
            'city_id' => 'required',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = auth('api')->user()->update($request->all());

        if($user){
            return response()->json([
                'message' => 'User successfully Updated',
                'user' => $user
            ], 201);
        }

    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }


    //change password

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' =>  'required|confirmed|min:6',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        if(!Hash::check($request->old_password, auth('api')->user()->password)){
            return response()->json([
                'message' => 'Old Password isnot Correct',
            ], 400);
            }
            $user = auth('api')->user()->update(['password' => bcrypt($request->new_password)]);

            return response()->json([
                'message' => 'Password updated successfully',
            ], 200);
    }


}
