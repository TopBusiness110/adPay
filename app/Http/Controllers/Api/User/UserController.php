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
    }


}
###############|> Made By https://github.com/eldapour (eldapour) 🚀
