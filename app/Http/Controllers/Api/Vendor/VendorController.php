<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Interfaces\Api\Vendor\VendorRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class VendorController extends Controller
{
    private VendorRepositoryInterface $vendorRepository;

    public function __construct(VendorRepositoryInterface $vendorRepository)
    {
       return $this->vendorRepository = $vendorRepository;
    } #|> constructor

    public function register(Request $request): JsonResponse
    {
        return $this->vendorRepository->register($request);
    } #|> register

    public function vendorHome(): JsonResponse
    {
        return $this->vendorRepository->vendorHome();
    } #|> vendorHome
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
    public function myProducts(Request $request): JsonResponse
    {
        return $this->vendorRepository->myProducts($request);
    } #|> myProducts



}
###############|> Made By https://github.com/eldapour (eldapour) 🚀
