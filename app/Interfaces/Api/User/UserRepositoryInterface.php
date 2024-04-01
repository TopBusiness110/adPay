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
}
###############|> Made By https://github.com/eldapour (eldapour) 🚀
