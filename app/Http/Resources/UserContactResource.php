<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\User_contact;
use Illuminate\Http\Resources\Json\JsonResource;

class UserContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'contact_id' => $this->contact_id,
            'custom_name'=> $this->custom_name,
            'contact_info' => new UserResource(User::find($this->contact_id))
        ];
    }
}
