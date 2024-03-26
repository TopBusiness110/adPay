<?php


use Illuminate\Support\Facades\{
    Route,
    Artisan,
};
use illuminate\Filesystem\symlink;
use App\Http\Controllers\Admin\{
    AuthController,
    MainController,
    UserController,
    AdminController,
    AdPackageController,
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

