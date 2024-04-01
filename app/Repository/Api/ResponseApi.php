<?php

namespace App\Repository\Api;

use App\Traits\FirebaseNotification;
use Illuminate\Http\JsonResponse;

class ResponseApi
{
    use FirebaseNotification;

    // returnDataSuccess
    public static function returnDataSuccess($model,$msg,$code=200): JsonResponse
    {
        return response()->json([
            'data' => $model,
            'msg' => $msg,
            'status'=> 1
        ],$code);
    }
    // returnDataFail
    public static function returnDataFail($model,$msg,$code): JsonResponse
    {
        return response()->json([
            'data' => $model,
            'msg' => $msg,
            'status'=> 0
        ],$code);
    }
    // get random token by length string
    public static function randomToken($length_of_string): string
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%&';
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }

    public function sendFcm($title, $body, $user_id = null, $created = false, $interest_id = null)
    {
        $data = array('title' => $title, 'body' => $body);
        return $this->sendFirebaseNotification($data, $user_id, $created, $interest_id);
    }
    public static function uploadImage($image)
    {
        $path = $image->store('uploads/vendors/images', 'public');
        return '/storage/' . $path;
    }
}
