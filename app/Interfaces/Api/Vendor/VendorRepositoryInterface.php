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
    public function myProducts(Request $request): JsonResponse;
}
###############|> Made By https://github.com/eldapour (eldapour) 🚀
