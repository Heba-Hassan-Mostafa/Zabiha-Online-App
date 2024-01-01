<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClientReviewController;
use App\Http\Controllers\Admin\DeliveryTimeController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\Products\OptionController;
use App\Http\Controllers\Admin\Products\ProductController;
use App\Http\Controllers\Admin\Products\CategoryController;
use App\Http\Controllers\Admin\Products\OptionValueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

  Route::group(['middleware'=>['auth','admin-access'],'prefix' => 'admin', 'as' => 'admin.'], function () {

      Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

      Route::resource('/roles'                   ,RoleController::class);
      Route::resource('/users'                   ,UserController::class);

      Route::resource('/categories'               , CategoryController::class);
      Route::resource('/options'                  , OptionController::class);
      Route::resource('/option-values'            , OptionValueController::class);
      Route::resource('/products'                 , ProductController::class);
      Route::resource('/slider'                   , SliderController::class);
      Route::get('/orders/cancel-order'           ,[OrderController::class,'cancelOrder'])->name('orders.cancel-order');
      Route::resource('/orders'                   ,OrderController::class);
      Route::resource('/coupons'                  ,CouponController::class);
      Route::resource('/delivery-time'            ,DeliveryTimeController::class);
      Route::resource('/contact-us'               ,ContactUsController::class);
      Route::resource('/settings'                 ,SettingController::class);
      Route::resource('/clients'                  ,ClientController::class);
      Route::resource('/client-reviews'           ,ClientReviewController::class);
      Route::get('/notifications/{notification}/mark-as-read' ,[NotificationController::class,'markAsRead'])->name('notifications.markAsRead');

      Route::resource('/notifications'           ,NotificationController::class);

  });
