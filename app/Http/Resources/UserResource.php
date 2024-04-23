<?php

namespace App\Http\Resources;

use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' =>$this->id,
            'name' =>$this->name,
            'image' =>asset($this->image),
            'phone' =>$this->phone,
            'type' =>$this->type,
            'device_token' =>$this->device_token,
            'session' =>$this->session,
            'token' =>  $request->header('Authorization') ??  'Bearer ' .$this->token,
        ]; //end UserResource 26-12-2023
    }
}
