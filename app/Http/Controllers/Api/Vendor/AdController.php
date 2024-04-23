<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Interfaces\Api\Vendor\VendorRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AdController extends Controller
{
    private VendorRepositoryInterface $vendorRepository;

    public function __construct(VendorRepositoryInterface $vendorRepository)
    {
        return $this->vendorRepository = $vendorRepository;
    } #|> constructor

    public function addAdvertise(Request $request): JsonResponse
    {
        return $this->vendorRepository->addAdvertise($request);
    } #|> addAdvertise

    public function myAdvertise(Request $request): JsonResponse
    {
        return $this->vendorRepository->myAdvertise($request);
    } #|> myAdvertise

    public function getAdPackages(): JsonResponse
    {
        return $this->vendorRepository->getAdPackages();
    } #|> getAdPackages


}
###############|> Made By https://github.com/eldapour (eldapour) 🚀
