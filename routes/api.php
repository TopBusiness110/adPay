<?php

use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\ConfigController;
use App\Http\Controllers\Api\User\PaymentController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Vendor\AdController;
use App\Http\Controllers\Api\Vendor\OrderController;
use App\Http\Controllers\Api\Vendor\ProductController;
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
Route::group(['prefix' => 'user'], function () {
    #|> User Authentication
    Route::post('register', [UserController::class, 'register']);


    #|> User Actions
    Route::group(['middleware' => 'jwt'],function () {
        Route::get('getHome', [UserController::class, 'getHome']);
        Route::get('getCategories', [UserController::class, 'getCategories']);
        Route::get('getRegions', [UserController::class, 'getRegions']);
        Route::get('getCityByRegion', [UserController::class, 'getCityByRegion']);
        Route::get('getProducts', [UserController::class, 'getProducts']);
        Route::get('getAuctions', [UserController::class, 'getAuctions']);
        Route::get('getMyAuctions', [UserController::class, 'getMyAuctions']);
        Route::get('getShops', [UserController::class, 'getShops']);
        Route::get('getAds', [UserController::class, 'getAds']);
        Route::get('auctionDetails/{id}', [UserController::class, 'auctionDetails']);
        Route::get('productDetails/{id}', [UserController::class, 'productDetails']);
        Route::get('myAuctionDetails/{id}', [UserController::class, 'myAuctionDetails']);
        Route::get('isSold/{id}', [UserController::class, 'isSold']);
        Route::post('editMyAuction/{id}', [UserController::class, 'editMyAuction']);
        Route::post('storeComment', [UserController::class, 'storeComment']);
        Route::get('vendorProfile/{id}', [UserController::class, 'vendorProfile']);
        Route::post('storeAuction', [UserController::class, 'storeAuction']);
        Route::post('storeFavorite', [UserController::class, 'storeFavorite']);
        Route::get('myFavorite', [UserController::class, 'myFavorite']);

        Route::post('sendContactUs', [UserController::class, 'sendContactUs']);


        Route::post('addToCart', [UserController::class, 'addToCart']);
        Route::get('getCart', [UserController::class, 'getCart']);
        Route::post('emptyCard', [UserController::class, 'emptyCard']);
        Route::post('deleteFromCart', [UserController::class, 'deleteFromCart']);

        // ADDRESS API
        Route::get('myAddresses', [UserController::class, 'myAddresses']);
        Route::post('addAddress', [UserController::class, 'addAddress']);
        Route::post('updateAddress', [UserController::class, 'updateAddress']);
        Route::post('deleteAddress/{id}', [UserController::class, 'deleteAddress']);

        // Order API
        Route::get('myOrders', [UserController::class, 'myOrders']);
        Route::get('order/d/{id}', [OrderController::class, 'orderDetails']);
        Route::post('rateVendor', [UserController::class, 'rateVendor']);

        //profile
        Route::post('updateProfile', [UserController::class, 'updateProfile']);
        Route::get('myAccount', [UserController::class, 'myAccount']);

        //My points
        Route::get('myCoins', [UserController::class, 'myCoins']);




    });



});
############|> END USER ROUTES























############|> START VENDOR ROUTES
Route::group(['prefix' => 'vendor'], function () {
    #|> Vendor Authentication
    Route::post('register', [VendorController::class, 'register']);

    #|> Vendor Actions
    Route::group(['middleware' => 'jwt'],function () {
        Route::get('home', [VendorController::class, 'vendorHome']);
        Route::get('getNotifications', [VendorController::class, 'getNotifications']);
        Route::get('getChatRooms', [VendorController::class, 'getChatRoom']);
        Route::get('getRoom/{id}', [VendorController::class, 'getRoom']);
        Route::post('room/{id}/sendMessage', [VendorController::class, 'sendMessage']);
        Route::post('room/updateSeen', [VendorController::class, 'updateSeen']);
        Route::get('myWallet', [VendorController::class, 'myWallet']);


        // products
        Route::post('addProduct', [ProductController::class, 'addProduct']);
        Route::post('updateProduct', [ProductController::class, 'updateProduct']);
        Route::post('deleteProduct', [ProductController::class, 'deleteProduct']);
        Route::get('productDetails/{id}', [ProductController::class, 'productDetails']);
        Route::get('myProducts', [ProductController::class, 'myProducts']);
        Route::get('getShopCategories', [ProductController::class, 'getShopCategories']);
        Route::get('getShopSubCategories', [ProductController::class, 'getShopSubCategories']);

        //advertises
        Route::post('addAdvertise', [AdController::class, 'addAdvertise']);
        Route::get('myAdvertise', [AdController::class, 'myAdvertise']);
        Route::get('getAdPackages', [AdController::class, 'getAdPackages']);

        // orders
        Route::get('orders', [OrderController::class, 'orders']);
        Route::post('changOrderStatus', [OrderController::class, 'changOrderStatus']);
        Route::get('order/d/{id}', [OrderController::class, 'orderDetails']);


    });
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
