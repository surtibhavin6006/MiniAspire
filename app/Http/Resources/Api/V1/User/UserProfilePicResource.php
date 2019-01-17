<?php

namespace App\Http\Resources\Api\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserProfilePicResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'profile_pic' => !empty($this->profile_pic) ? Storage::url(config('general.file_path.user_profile').$this->profile_pic) : '',
        ];
    }
}
