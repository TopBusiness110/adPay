<?php


use Illuminate\Support\Facades\{
    Route,
    Artisan,
};
use illuminate\Filesystem\symlink;
use App\Http\Controllers\Admin\{
    AdController,
    AuthController,
    MainController,
    UserController,
    AdminController,
    AdPackageController,
    AppUserController,
    AuctionCategoryController,
    AuctionController,
    AuctionSubCategoryController,
    CityController,
    ConfigCountController,
    CouponController,
    InterestController,
    MsgController,
    NotificationController,
    PackageController,
    PackageUserController,
    SliderController,
    UserActionController,
    TubeController,
    ModelPriceController,
    OrderController,
    PaymentTransactionController,
    SettingController,
    WithdrawController,
    YoutubeKeyController
};

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('admin.login');
    Route::POST('login', [AuthController::class, 'login'])->name('admin.login');
});

Route::get('/', function () {
    return redirect()->route('adminHome');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:user'], function () {
    Route::get('/', [MainController::class, 'index'])->name('adminHome');
    #============================ Admin ====================================
    Route::get('admins', [AdminController::class, 'index'])->name('admin.index');
    Route::get('admin/create', [AdminController::class, 'showCreate'])->name('admin.create');
    Route::post('admin/store', [AdminController::class, 'storeAdmin'])->name('admin.store');
    Route::get('admin/{id}/edit', [AdminController::class, 'showEdit'])->name('admin.edit');
    Route::put('admin/update/{id}', [AdminController::class, 'updateAdmin'])->name('admin.update');
    Route::delete('admin/{id}/delete', [AdminController::class, 'delete'])->name('delete.admin');
    Route::get('my_profile', [AdminController::class, 'myProfile'])->name('myProfile');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

    #============================ users ====================================
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::delete('user/{id}/delete', [UserController::class, 'delete'])->name('user_delete');
    Route::post('change-status-user', [UserController::class, 'changeStatusUser'])->name('changeStatusUser');



    #============================ AdPackage =====================================
    Route::get('ad_packages', [AdPackageController::class, 'index'])->name('ad_packages.index');
    Route::get('ad_packages/create', [AdPackageController::class, 'showCreate'])->name('ad_packages.create');
    Route::post('ad_packages/store', [AdPackageController::class, 'store'])->name('ad_packages.store');
    Route::get('ad_packages/{id}/edit', [AdPackageController::class, 'showEdit'])->name('ad_packages.edit');
    Route::put('ad_packages/update/{id}', [AdPackageController::class, 'update'])->name('ad_packages.update');
    Route::delete('ad_packages/{id}/delete', [AdPackageController::class, 'delete'])->name('ad_packages.delete');

    #============================ Auction Category =====================================
    Route::get('auction_categories', [AuctionCategoryController::class, 'index'])->name('auctionCategories.index');
    Route::get('auction_categorY/create', [AuctionCategoryController::class, 'showCreate'])->name('auctionCategory.create');
    Route::post('auction_categorY/store', [AuctionCategoryController::class, 'store'])->name('auctionCategory.store');
    Route::get('auction_categorY/{id}/edit', [AuctionCategoryController::class, 'showEdit'])->name('auctionCategory.edit');
    Route::put('auction_categorY/update/{id}', [AuctionCategoryController::class, 'update'])->name('auctionCategory.update');
    Route::delete('auction_categorY/{id}/delete', [AuctionCategoryController::class, 'delete'])->name('auctionCategory.delete');

    #============================ Auction Sub Category =====================================
    Route::get('auction_sub_categories', [AuctionSubCategoryController::class, 'index'])->name('auctionSubCategories.index');
    Route::get('auction_sub_category/create', [AuctionSubCategoryController::class, 'showCreate'])->name('auctionSubCategory.create');
    Route::post('auction_sub_category/store', [AuctionSubCategoryController::class, 'store'])->name('auctionSubCategory.store');
    Route::get('auction_sub_category/{id}/edit', [AuctionSubCategoryController::class, 'showEdit'])->name('auctionSubCategory.edit');
    Route::put('auction_sub_category/update/{id}', [AuctionSubCategoryController::class, 'update'])->name('auctionSubCategory.update');
    Route::delete('auction_sub_category/{id}/delete', [AuctionSubCategoryController::class, 'delete'])->name('auctionSubCategory.delete');

    #============================ Ads =====================================
    Route::get('ads', [AdController::class, 'index'])->name('ads.index');
    Route::delete('ad/{id}/delete', [AdController::class, 'delete'])->name('ad.delete');

    #============================ App User =====================================
    Route::get('app_users', [AppUserController::class, 'index'])->name('appUsers.index');
    Route::delete('app_user/{id}/delete', [AppUserController::class, 'delete'])->name('appUser.delete');

    #============================ Auction =====================================
    Route::get('auctions', [AuctionController::class, 'index'])->name('auctions.index');
    Route::delete('auction/{id}/delete', [AuctionController::class, 'delete'])->name('auction.delete');

    #============================ Notification =====================================
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notification/create', [NotificationController::class, 'showCreate'])->name('notification.create');
    Route::post('notification/store', [NotificationController::class, 'store'])->name('notification.store');
    Route::delete('notification/{id}/delete', [NotificationController::class, 'delete'])->name('notification.delete');
    Route::get('/get-users', [NotificationController::class, 'getUsers'])->name('get_users');

    #============================ Order =====================================
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::delete('order/{id}/delete', [OrderController::class, 'delete'])->name('order.delete');
});




#=======================================================================
#============================ ROOT =====================================
#=======================================================================
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('key:generate');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    Artisan::call('storage:link');
    return response()->json(['status' => 'success', 'code' => 1000000000]);
});
