<?php

namespace App\Http\Resources\Api\V1\Loan\Type;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanTypeResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'interest_type' => $this->interest_type,
            'interest_rate' => $this->interest_rate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
