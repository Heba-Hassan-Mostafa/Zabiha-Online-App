<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPassword;
use App\Http\Controllers\Api\Orders\CartController;
use App\Http\Controllers\Api\Orders\OrderController;
use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Api\Categories\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['changeLanguage']], function () {
Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    //auth
    Route::post('/login',           [AuthController::class, 'login']);
    Route::post('/register',        [AuthController::class, 'register']);
    Route::post('/logout',          [AuthController::class, 'logout']);
    Route::post('/refresh',         [AuthController::class, 'refresh']);
    Route::get('/user-profile',     [AuthController::class, 'userProfile']);
    Route::post('/update-profile',  [AuthController::class, 'updateProfile']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    //forgot-password
    Route::post('/forgot-password', [ForgotPassword::class, 'forgotPassword']);
    Route::post('/reset-password',  [ForgotPassword::class, 'resetPassword']);

});

    Route::post('/change-language',    [GeneralController::class, 'changeLanguage']);

    //get cities
    Route::get('/cities',               [GeneralController::class, 'getAllCities']);
    Route::get('/cities-shopping-cost', [GeneralController::class, 'getCitiesWithShoppingCost']);

    Route::get('/users',                [GeneralController::class, 'getAllUsers']);
    Route::get('/settings',             [GeneralController::class, 'setting']);
    Route::post('/contact-us',          [GeneralController::class, 'contact_us']);
    
    


    //categories
    Route::get('/get-categories',          [CategoryController::class, 'getAllCategories']);
    Route::get('/get-categories-products', [CategoryController::class, 'getCategoriesProducts']);
    Route::get('/get-category-byId/{id}',  [CategoryController::class, 'getCategoryById']);


    //products
    Route::get('/get-products',              [CategoryController::class, 'getAllProducts']);
    Route::get('/get-product-byId/{id}',     [CategoryController::class, 'getProductById']);
    Route::get('/get-product-category/{id}', [CategoryController::class, 'getProductCategory']);

    //options
     Route::get('/get-options',              [CategoryController::class, 'getAllOptions']);
     Route::get('/get-option-values/{id}',   [CategoryController::class, 'getOptionValue']);
     Route::get('/get-option-with-values',   [CategoryController::class, 'getOptionWithValue']);
     Route::get('/image-slider',             [CategoryController::class, 'imageSlider']);
     Route::get('/search/{name}',            [CategoryController::class, 'search']);


     Route::group(['middleware' => ['jwt.verify']], function () {

        //delete account 
    Route::delete('/delete-account',         [GeneralController::class, 'deleteAccount']);
     //Cart
    Route::get('/get-cart-products',         [CartController::class, 'getCartItems']);
    Route::post('/add-to-cart',              [CartController::class, 'addToCart']);
    Route::post('/update-cart/{id}',         [CartController::class, 'updateCartItem']);
    Route::post('/delete-product-cart/{id}', [CartController::class, 'deleteProductFromCart']);
    Route::post('/delete-all-product-cart',  [CartController::class, 'deleteAllCartItems']);
    Route::get('/cart-count',                [CartController::class, 'CartCount']);

     //orders
     Route::post('/create-order',            [OrderController::class, 'createOrder']);
     Route::get('/order-details/{id}',       [OrderController::class, 'orderDetails']);
     Route::get('/user-current-orders',      [OrderController::class, 'currentOrders']);
     Route::get('/user-complete-orders',     [OrderController::class, 'completedOrders']);
     Route::get('/delivery-time',            [OrderController::class, 'deliveryTime']);


     Route::get('/get-all-cancel-reasons', [OrderController::class, 'cancelReasons']);
     Route::post('/cancel-order',          [OrderController::class, 'cancelOrder']);

     Route::post('/order-review',          [OrderController::class, 'orderReview']);
     Route::post('/check-coupon',          [OrderController::class, 'checkCoupon']);

     Route::get('/get-all-notifications',  [OrderController::class, 'getAllNotifications']);
     Route::get('/count-notifications',    [OrderController::class, 'notificationCount']);



    });
      });