<?php

use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\ConfigController;
use App\Http\Controllers\Api\User\PaymentController;
use App\Http\Controllers\Api\Vendor\VendorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| |> API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

############|> START AUTH ROUTES
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('index');
    Route::post('checkUser', [AuthController::class, 'checkUser']);
    Route::post('resetPassword', [AuthController::class, 'resetPassword']);

    Route::group(['middleware' => 'jwt'], function () {
        #|> Auth Action
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('deleteUser', [AuthController::class, 'deleteUser']);
    });
});
############|> END AUTH ROUTES


############|> START USER ROUTES
Route::group(['middleware' => 'jwt', 'prefix' => 'user'], function () {

});
############|> END USER ROUTES


############|> START VENDOR ROUTES
Route::group(['prefix' => 'vendor'], function () {
    #|> Vendor Authentication
    Route::post('register', [VendorController::class, 'register']);
    Route::get('home', [VendorController::class, 'vendorHome']);
    Route::get('orders', [VendorController::class, 'orders']);
    Route::get('order/d/{id}', [VendorController::class, 'orderDetails']);
    Route::get('myProducts', [VendorController::class, 'myProducts']);
    Route::post('changOrderStatus', [VendorController::class, 'changOrderStatus']);
});

Route::group(['middleware' => 'jwt', 'prefix' => 'vendor'], function () {

});

############|> END VENDOR ROUTES


/*
 ? |> START PAYMENT ROUTES
 ? |> ROUTE GO PAY TO CREATE PAYMENT BY PAYMOB
 ! |> ROUTE PAYMENT/CALLBACK TO GET RESPONSE FROM PAYMOB =>> TURE OR FALSE
 ? |> ROUTE CHECKOUT TO FINISH PAYMENT BY PAYMOB
 */
############|> START PAYMENT ROUTES

#|> create new payment & order
Route::post('goPay', [PaymentController::class, 'goPay'])->middleware('jwt');
#|> callback payment true or false
Route::get('payment/callback', [PaymentController::class, 'callback']);
#|> check out & finish payment
Route::post('checkout', [PaymentController::class, 'checkout']);

############|> END PAYMENT ROUTES


############|> START FCM TEST ROUTES
Route::post('testFcm', [ConfigController::class, 'testFcm']);
############|> END FCM TEST ROUTES

############|> START get Active Key ROUTES
Route::get('getActiveKey', [ConfigController::class, 'getActiveKey']);
############|> END get Active Key ROUTES
