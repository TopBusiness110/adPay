<?php

namespace App\Http\Resources;

use App\Models\AppUser;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'id'=>$this->id,
            'transaction_id'=>$this->transaction_id,
            'amount'=>$this->amount,
            'type'=>$this->type,
            'status'=>$this->status,
            'created_at'=> Carbon::parse($this->created_at)->format('dD MY h:iA'),
        ]; //end return array with data
    }
}
