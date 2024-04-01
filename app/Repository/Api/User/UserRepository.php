<?php

namespace App\Repository\Api\User;


use App\Http\Resources\UserResource;
use App\Http\Resources\VendorResource;
use App\Interfaces\Api\User\UserRepositoryInterface;
use App\Models\AppUser;
use App\Repository\Api\ResponseApi;
use App\Traits\FirebaseNotification;
use App\Traits\PhotoTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserRepository extends ResponseApi implements UserRepositoryInterface
{
    use PhotoTrait, FirebaseNotification;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try {
            // Validation Rules
            $validatorLogin = Validator::make($request->all(), [
                'phone' => 'required',
                'device_token' => 'required',
                'password' => 'required'
            ]);

            if ($validatorLogin->fails()) {
                $errors = $validatorLogin->errors()->first();
                return self::returnDataFail(null, $errors, 422);
            } else {
                $check_exists = AppUser::query()
                    ->where('phone', '=', $request->phone)
                    ->where('device_token', '=', $request->device_token)
                    ->first();

                if ($check_exists) {
                    // Authenticate User
                    $credentials = ['phone' => $request->phone, 'password' => $request->password];
                    $token = Auth::guard('user-api')->attempt($credentials);
                    if (!$token){
                        return self::returnDataFail(null, 'phone or password is not correct !',200);
                    }
                    // Get User and Attach Token
                    $user = Auth::guard('user-api')->user();
                    $user['token'] = $token;

                    AppUser::find($user->id)->update(['session' => session()->getId()]);

                    return self::returnDataSuccess(new UserResource($user), 'login success');
                }
                return self::returnDataFail(null, 'user not exists', 200);
            }
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    }// end login

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            Auth::guard('user-api')->logout(); // Logout the user
            return self::returnDataSuccess(null, "successfully logged out");
        } catch (\Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // logout

    /**
     * @return JsonResponse
     */
    public function deleteAccount(): JsonResponse
    {
        try {

            $user = AppUser::find(Auth::guard('user-api')->user()->id);
            $user->delete();
            Auth::guard('user-api')->logout();

            return self::returnDataSuccess(null, "Account deleted successfully and logout");
        } catch (\Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // deleteAccount


    public function checkUser(Request $request): JsonResponse
    {
        try {
            // Validation Rules
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return self::returnDataFail(null, $errors, 422);
            } else {
                $check_exists = AppUser::query()
                    ->where('phone', $request->phone)
                    ->first();
                if ($check_exists) {
                    if ($check_exists->type == 'vendor') {
                        return self::returnDataSuccess(new VendorResource($check_exists), 'user is exists');
                    } else {
                        return self::returnDataSuccess(new UserResource($check_exists), 'user is exists');
                    }
                } else {
                    return self::returnDataFail(null, 'user doesnt exists', 422);
                }
            }

        } catch (\Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    }

    public function resetPassword(Request $request): JsonResponse
    {
        try {
            // Validation Rules
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed',
                'phone'=>'required'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return self::returnDataFail(null, $errors, 422);
            } else {
                $check_exists = AppUser::query()
                    ->where('phone', $request->phone)
                    ->first();
                if ($check_exists) {
                    $check_exists->password = \Hash::make($request->password);
                    $check_exists->save();
                    if ($check_exists->type == 'vendor') {
                        return self::returnDataSuccess(null, 'password updated successfully');
                    } else {
                        return self::returnDataSuccess(null, 'password updated successfully');
                    }
                } else {
                    return self::returnDataFail(null, 'user doesnt exists', 422);
                }
            }
        } catch (\Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    }


} // eldapour
###############|> Made By https://github.com/eldapour (eldapour) 🚀
