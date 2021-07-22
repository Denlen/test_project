<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            // 'company_id' => $this->company_id,
            'company' => CompanyResource::make($this->whenLoaded('company')),
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
}
