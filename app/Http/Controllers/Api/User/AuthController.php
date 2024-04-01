<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Api\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {

        $this->userRepository = $userRepository;

    } // constructor

    public function login(Request $request): JsonResponse
    {
        return $this->userRepository->login($request);
    } // end loginWithGoogle

    public function logout(): JsonResponse
    {
        return $this->userRepository->logout();
    } // end logout

    public function deleteUser(): JsonResponse
    {
        return $this->userRepository->deleteAccount();
    } // end deleteUser

    public function checkUser(Request $request): JsonResponse
    {
        return $this->userRepository->checkUser($request);
    } // checkUser

    public function resetPassword(Request $request): JsonResponse
    {
        return $this->userRepository->resetPassword($request);
    } // resetPassword


}
