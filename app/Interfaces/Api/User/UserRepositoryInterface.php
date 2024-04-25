<?php

namespace App\Interfaces\Api\User;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse;

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse;

    /**
     * @return JsonResponse
     */
    public function deleteAccount(): JsonResponse;

    /**
     * @param Request $request
     * @return mixed
     */
    public function checkUser(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function resetPassword(Request $request): JsonResponse;

    /**
     * @return JsonResponse
     */
    public function getHome(): JsonResponse;

    /**
     * @return JsonResponse
     */
    public function getCategories(): JsonResponse;

    /**
     * @return JsonResponse
     */
    public function myAddresses(): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addAddress(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateAddress(Request $request): JsonResponse;

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteAddress($id): JsonResponse;

    /**
     * @return JsonResponse
     */
    public function getRegions(): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getCityByRegion(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getProducts(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAuctions(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getShops(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAds(Request $request): JsonResponse;

    /**
     * @param $id
     * @return JsonResponse
     */
    public function productDetails($id): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addToCart(Request $request): JsonResponse;

    /**
     * @return JsonResponse
     */
    public function getCart(): JsonResponse;

    /**
     * @param $id
     * @return JsonResponse
     */
    public function auctionDetails($id): JsonResponse;

    /**
     * @param $request
     * @return JsonResponse
     */
    public function storeComment($request): JsonResponse;

    /**
     * @param $request
     * @return JsonResponse
     */
    public function vendorProfile($request): JsonResponse;

    /**
     * @param $request
     * @return JsonResponse
     */
    public function storeAuction($request): JsonResponse;

}
###############|> Made By https://github.com/eldapour (eldapour) 🚀
