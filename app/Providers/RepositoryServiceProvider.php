<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Api\User\UserRepositoryInterface;
use App\Interfaces\Api\User\PaymentRepositoryInterface;
use App\Repository\Api\User\UserRepository as UserApiRepository;
use App\Repository\Api\User\PaymentRepository as PaymentApiRepository;

use App\Interfaces\{
    AdInterface,
    AuthInterface,
    UserInterface,
    AdminInterface,
    AdPackageInterface,
    AppUserInterface,
    AuctionCategoryInterface,
    AuctionInterface,
    AuctionSubCategoryInterface,
    MainInterface,
    NotificationInterface,
    OrderInterface,
    ProductInterface,
    ShopCategoryInterface
};
use App\Models\ShopCategory;
use App\Repository\{
    AdminRepository,
    AuthRepository,
    UserRepository,
    AdPackageRepository,
    AdRepository,
    AppUserRepository,
    AuctionCategoryRepository,
    AuctionRepository,
    AuctionSubCategoryRepository,
    MainRepository,
    NotificationRepository,
    OrderRepository,
    ProductRepository,
    ShopCategoryRepository
};



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
