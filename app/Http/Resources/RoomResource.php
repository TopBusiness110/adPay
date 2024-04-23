<?php

namespace App\Http\Resources;

use App\Models\Ad;
use App\Models\Chat;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $unseen_count = Chat::query()->where('room_id', $this->id)
            ->where('to_user_id', auth('user-api')->user()->id)->where('seen', 0)
            ->count();
        if ($this->model_type == 'advertise') {
            $model = new AdResource(Ad::find($this->model_id));
        }else {
            $model = new ProductResource(Product::find($this->model_id));
        }
        return [
            'id' => $this->id,
            'unseen_count' => $unseen_count,
            'from_user' => ($this->fromUser->type == 'vendor') ? new VendorResource($this->fromUser) : new UserResource($this->fromUser),
            'to_user' => ($this->toUser->type == 'vendor') ? new VendorResource($this->toUser) : new UserResource($this->toUser),
            'model' => $model,
            'model_type' => $this->model_type,
            'created_at' => $this->created_at
        ]; //end return array with data
    }
}
