<?php

namespace App\Http\Resources;

use App\Models\AppUser;
use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $vendor = AppUser::find($this->vendor_id);
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
            'price' => $this->price,
            'discount' => $this->discount,
            'type' => $this->type,
            'shop_sub_cat' => $this->shop_sub_cat,
            'stock' => $this->stock,
            'props' => $this->props,
            'vendor' => new VendorResource($vendor),
        ]; //end return array with data
    }
}
