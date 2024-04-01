<?php

namespace App\Providers;

use App\Interfaces\{AdInterface,
    AdminInterface,
    AdPackageInterface,
    Api\Vendor\VendorRepositoryInterface,
    AppUserInterface,
    AuctionCategoryInterface,
    AuctionInterface,
    AuctionSubCategoryInterface,
    AuthInterface,
    MainInterface,
    UserInterface};
use App\Interfaces\Api\User\PaymentRepositoryInterface;
use App\Interfaces\Api\User\UserRepositoryInterface;
use App\Repository\{AdminRepository,
    AdPackageRepository,
    AdRepository,
    Api\Vendor\VendorRepository,
    AppUserRepository,
    AuctionCategoryRepository,
    AuctionRepository,
    AuctionSubCategoryRepository,
    AuthRepository,
    MainRepository,
    UserRepository};
use App\Repository\Api\User\PaymentRepository as PaymentApiRepository;
use App\Repository\Api\User\UserRepository as UserApiRepository;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        // start Web classes and interfaces
        $this->app->bind(MainInterface::class,MainRepository::class);
        $this->app->bind(AuthInterface::class,AuthRepository::class);
        $this->app->bind(AdminInterface::class,AdminRepository::class);
        $this->app->bind(UserInterface::class,UserRepository::class);
        $this->app->bind(AdPackageInterface::class,AdPackageRepository::class);
        $this->app->bind(AdInterface::class,AdRepository::class);
        $this->app->bind(AppUserInterface::class,AppUserRepository::class);
        $this->app->bind(AuctionCategoryInterface::class,AuctionCategoryRepository::class);
        $this->app->bind(AuctionSubCategoryInterface::class,AuctionSubCategoryRepository::class);
        $this->app->bind(AuctionInterface::class,AuctionRepository::class);
        // ----------------------------------------------------------------


        // start Api classes and interfaces
        $this->app->bind(UserRepositoryInterface::class,UserApiRepository::class);
        $this->app->bind(VendorRepositoryInterface::class,VendorRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class,PaymentApiRepository::class);
        // ----------------------------------------------------------------

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
