<?php

namespace App\Http\Resources;

use App\Models\AppUser;
use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = AppUser::find(auth('user-api')->user()->id);
        return [
            'id'=>$this->id,
            'image' => asset($this->image),
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_ar,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'status' => $this->status,
            'count_views' => $this->count_views,
            'package' => $this->package,
            'views' => $this->views,
            'complete' => $this->complete,
            'video' => asset($this->video),
            'payment_status' => $this->payment_status,
            'user' => ($user->type == 'vendor') ? new VendorResource($user) : new UserResource($user),
        ]; //end return array with data
    }
}
