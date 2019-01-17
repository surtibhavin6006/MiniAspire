<?php

namespace App\Http\Resources\Api\V1\User;

use App\Http\Resources\Api\V1\Role\RolesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    =>  (string)$this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'zipcode' => $this->zipcode,
            'mobile_number' => $this->mobile_number,
            'gender' => $this->gender,
            'email_verified_at' => $this->email_verified_at,
            'profile_pic' => !empty($this->profile_pic) ? Storage::url(config('general.file_path.user_profile').$this->profile_pic) : '',
            'role' =>  new RolesResource($this->whenLoaded('role')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
