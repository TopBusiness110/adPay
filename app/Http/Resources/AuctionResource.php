<?php

namespace App\Http\Resources;

use App\Models\AppUser;
use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class AuctionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $images = [];

        foreach ($this->images as $image) {
            $images[] = asset($image);
        }

        return [
            'id' => $this->id,
            'images' => $images,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'video' => $this->video,
            'category' => $this->auctionCategory,
            'sub_category' => $this->auctionSubCategory,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'comments' => CommentResource::collection($this->comments),
            'user' => new UserResource($this->user),
        ]; //end return array with data
    }
}
