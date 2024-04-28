<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Api\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    } #|> constructor

    public function register(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->register($request);
    } #|> register

    public function getHome(): JsonResponse
    {
        return $this->userRepositoryInterface->getHome();
    } #|> home

    public function getCategories(): JsonResponse
    {
        return $this->userRepositoryInterface->getCategories();
    } #|> getCategories

    public function myAddresses(): JsonResponse
    {
        return $this->userRepositoryInterface->myAddresses();
    } #|> myAddresses

    public function addAddress(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->addAddress($request);
    } #|>  addAddress

    public function updateAddress(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->updateAddress($request);
    } #|>  updateAddress

    public function deleteAddress($id): JsonResponse
    {
        return $this->userRepositoryInterface->deleteAddress($id);
    } #|>  deleteAddress

    public function getRegions(): JsonResponse
    {
        return $this->userRepositoryInterface->getRegions();
    } #|>  getRegions

    public function getCityByRegion(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->getCityByRegion($request);
    } #|>  getCityByRegion

    public function getProducts(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->getProducts($request);
    } #|>  getProducts

    public function getAuctions(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->getAuctions($request);
    } #|>  getProducts

    public function getShops(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->getShops($request);
    } #|>  getShops

    public function getAds(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->getAds($request);
    } #|>  getAds

    public function productDetails($id): JsonResponse
    {
        return $this->userRepositoryInterface->productDetails($id);
    } #|>  productDetails

    public function auctionDetails($id): JsonResponse
    {
        return $this->userRepositoryInterface->auctionDetails($id);
    } #|>  auctionDetails

    public function addToCart(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->addToCart($request);
    } #|>  addToCart

    public function getCart(): JsonResponse
    {
        return $this->userRepositoryInterface->getCart();
    }#|>  getCart

    public function storeComment(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->storeComment($request);
    }#|>  storeComment

    public function myOrders(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->myOrders($request);
    }#|> myOrders

    public function rateVendor(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->rateVendor($request);
    }#|> rateVendor

    public function vendorProfile(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->vendorProfile($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeAuction(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->storeAuction($request);
    }

    /**
     * @return JsonResponse
     */

    public function emptyCard(): JsonResponse
    {
        return $this->userRepositoryInterface->emptyCard();
    }

    /**
     * @return JsonResponse
     */
    public function deleteFromCart(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->deleteFromCart( $request);
    }

    public function getMyAuctions(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->getMyAuctions( $request);
    }


   public function myAuctionDetails(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->myAuctionDetails($request);
    }

    public function isSold(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->isSold($request);
    }


    public function editMyAuction(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->editMyAuction($request);
    }

    public function storeFavorite(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->storeFavorite($request);
    }

     public function myFavorite(): JsonResponse
    {
        return $this->userRepositoryInterface->myFavorite();
    }

    public function updateProfile(Request $request): JsonResponse
    {
//        return response()->json($request->all());
        return $this->userRepositoryInterface->updateProfile( $request);
    }

    public function sendContactUs(Request $request): JsonResponse
    {
        return $this->userRepositoryInterface->sendContactUs($request);
    }


}
###############|> Made By https://github.com/eldapour (eldapour) 🚀
