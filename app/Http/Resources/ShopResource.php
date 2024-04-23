<?php

namespace App\Http\Resources;

use App\Models\AppUser;
use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            'logo' => asset($this->logo),
            'banner' =>asset($this->banner),
            'title_ar' =>$this->title_ar,
            'title_en' =>$this->title_en,
            'shop_cat' =>$this->category,
            'shop_sub_cat' =>$this->shop_sub_cat,
            'vendor' => new VendorResource($this->vendor),
        ]; //end return array with data
    }
}
