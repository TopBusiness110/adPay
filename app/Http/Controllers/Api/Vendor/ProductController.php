<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Interfaces\Api\Vendor\VendorRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    private VendorRepositoryInterface $vendorRepository;

    public function __construct(VendorRepositoryInterface $vendorRepository)
    {
        return $this->vendorRepository = $vendorRepository;
    } #|> constructor

    public function addProduct(Request $request): JsonResponse
    {
        return $this->vendorRepository->addProduct($request);
    }
    public function updateProduct(Request $request): JsonResponse
    {
        return $this->vendorRepository->updateProduct($request);
    }
    public function productDetails($id): JsonResponse
    {
        return $this->vendorRepository->productDetails($id);
    }
    public function deleteProduct(Request $request): JsonResponse
    {
        return $this->vendorRepository->deleteProduct($request);
    }
    public function myProducts(Request $request): JsonResponse
    {
        return $this->vendorRepository->myProducts($request);
    } #|> myProducts

    public function getShopCategories(): JsonResponse
    {
        return $this->vendorRepository->getShopCategories();
    } #|> getShopCategories

    public function getShopSubCategories(): JsonResponse
    {
        return $this->vendorRepository->getShopSubCategories();
    } #|> getShopCategories


}
###############|> Made By https://github.com/eldapour (eldapour) 🚀
