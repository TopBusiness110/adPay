<?php

namespace App\Traits;

use App\Models\AppUser;
use App\Models\Notification;

trait FirebaseNotification
{

    //firebase server key
    protected string $serverKey = 'AAAA4_4xA3o:APA91bFHUAdSecpTOgP0WR_FlX4tC-bRYdZNn0RezY_1dd__1WmdQeDLUzRWaT-mh86cJoRedQL1xh7f2gXFtuQNDTsdS5CFls_cKmhZX5_ztUQm51MqBd8JBEpVV_y1rO_Ftw8XTsTh';


    public function sendFirebaseNotification($data, $user_id = null,$created = false)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        if ($user_id != null) {
            $tokens = AppUser::whereId($user_id)->pluck('device_token')->toArray();
        }else {
            $tokens = AppUser::get()->pluck('device_token')->toArray();
        }


        if (!$created) {
            //|> start notification store
            $createNotification = new Notification();
            $createNotification->title = $data['title'];
            $createNotification->description = $data['body'];
            $createNotification->user_id = $user_id ?? null;
            $createNotification->type = $user_type ?? null;
            $createNotification->save();
        }

        $fields = array(
            'registration_ids' => $tokens,
            'notification' => $data,
            'data' => [
                "note_type" => "notification",
                "message" => isset($data['msg']) ? $data['msg'] : []
            ]
        );
        $fields = json_encode($fields);

        $headers = array(
            'Authorization: key=' . $this->serverKey,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
}
