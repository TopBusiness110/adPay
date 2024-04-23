<?php

namespace App\Providers;
use App\Interfaces\AdInterface;
use App\Interfaces\AdminInterface;
use App\Interfaces\AdPackageInterface;
use App\Interfaces\AppUserInterface;
use App\Interfaces\AuctionCategoryInterface;
use App\Interfaces\AuctionInterface;
use App\Interfaces\AuctionSubCategoryInterface;
use App\Interfaces\AuthInterface;
use App\Interfaces\MainInterface;
use App\Interfaces\NotificationInterface;
use App\Interfaces\OrderInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\ShopCategoryInterface;
use App\Interfaces\UserInterface;
use App\Repository\AdminRepository;
use App\Repository\AdPackageRepository;
use App\Repository\AdRepository;
use App\Repository\AppUserRepository;
use App\Repository\AuctionCategoryRepository;
use App\Repository\AuctionRepository;
use App\Repository\AuctionSubCategoryRepository;
use App\Repository\AuthRepository;
use App\Repository\MainRepository;
use App\Repository\NotificationRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\ShopCategoryRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Models\ShopCategory;

//api
use App\Repository\Api\User\PaymentRepository as PaymentApiRepository;
use App\Repository\Api\User\UserRepository as UserApiRepository;
use App\Repository\Api\Vendor\VendorRepository;
use App\Interfaces\Api\User\PaymentRepositoryInterface;
use App\Interfaces\Api\User\UserRepositoryInterface;
use App\Interfaces\Api\Vendor\VendorRepositoryInterface;


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
        $this->app->bind(NotificationInterface::class,NotificationRepository::class);
        $this->app->bind(OrderInterface::class,OrderRepository::class);
        $this->app->bind(ShopCategoryInterface::class,ShopCategoryRepository::class);
        $this->app->bind(ProductInterface::class,ProductRepository::class);
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
