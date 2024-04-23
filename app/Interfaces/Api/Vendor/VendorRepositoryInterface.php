<?php

namespace App\Interfaces\Api\Vendor;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface VendorRepositoryInterface
{
    public function register(Request $request): JsonResponse;
    public function vendorHome(): JsonResponse;
    public function orders(Request $request): JsonResponse;
    public function orderDetails($id): JsonResponse;
    public function changOrderStatus(Request $request): JsonResponse;
    public function addProduct(Request $request): JsonResponse;
    public function updateProduct(Request $request): JsonResponse;
    public function deleteProduct(Request $request): JsonResponse;
    public function productDetails($id): JsonResponse;
    public function myProducts(Request $request): JsonResponse;
    public function getShopCategories(): JsonResponse;
    public function getShopSubCategories(): JsonResponse;

    public function addAdvertise(Request $request): JsonResponse;
    public function myAdvertise(Request $request): JsonResponse;
    public function getAdPackages(): JsonResponse;
    public function getNotifications(): JsonResponse;
    public function getChatRoom(): JsonResponse;
    public function getRoom($user_id): JsonResponse;
    public function sendMessage(Request $request,$id): JsonResponse;
    public function updateSeen(): JsonResponse;
    public function myWallet(): JsonResponse;
}
###############|> Made By https://github.com/eldapour (eldapour) 🚀
