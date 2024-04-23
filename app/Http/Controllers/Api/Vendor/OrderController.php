<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Interfaces\Api\Vendor\VendorRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    private VendorRepositoryInterface $vendorRepository;

    public function __construct(VendorRepositoryInterface $vendorRepository)
    {
        return $this->vendorRepository = $vendorRepository;
    } #|> constructor

    public function orders(Request $request): JsonResponse
    {
        return $this->vendorRepository->orders($request);
    } #|> orders

    public function orderDetails($id): JsonResponse
    {
        return $this->vendorRepository->orderDetails($id);
    } #|> orderDetails

    public function changOrderStatus(Request $request): JsonResponse
    {
        return $this->vendorRepository->changOrderStatus($request);
    } #|> orderDetails


}
###############|> Made By https://github.com/eldapour (eldapour) 🚀
