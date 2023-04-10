<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class symptom_user extends JsonResource
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
            'id'=> $this->id,
            'user_id'=> $this->user_id,
            'et_1'=> $this->et_1,
            'et_2'=> $this->et_2,
            'et_3'=> $this->et_3,
            'et_4'=> $this->et_4,
            'et_5'=> $this->et_5,
            'et_6'=> $this->et_6,
        ];
    }
}
