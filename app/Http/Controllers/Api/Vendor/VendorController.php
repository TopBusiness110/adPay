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

    public function getNotifications(): JsonResponse
    {
        return $this->vendorRepository->getNotifications();
    } #|> getNotifications

    public function getChatRoom(): JsonResponse
    {
        return $this->vendorRepository->getChatRoom();
    } #|> getChatRoom
    public function getRoom($user_id): JsonResponse
    {
        return $this->vendorRepository->getRoom($user_id);
    } #|> sendMessage
     public function sendMessage(Request $request,$id): JsonResponse
    {
        return $this->vendorRepository->sendMessage($request,$id);
    } #|> sendMessage
public function updateSeen(): JsonResponse
    {
        return $this->vendorRepository->updateSeen();
    } #|> sendMessage

    public function myWallet(): JsonResponse
    {
        return $this->vendorRepository->myWallet();
    } #|> myWallet
      public function vendorProfile($id): JsonResponse
    {
        return $this->vendorRepository->vendorProfile($id);
    } #|> myWallet


}
###############|> Made By https://github.com/eldapour (eldapour) 🚀
