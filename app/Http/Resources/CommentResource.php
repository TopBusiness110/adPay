<?php

namespace App\Http\Resources;

use App\Models\AppUser;
use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'comment' =>$this->comment,
            'user_id' => $this->user,
            'replies' => CommentResource::collection($this->replies),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ]; //end return array with data
    }
}
