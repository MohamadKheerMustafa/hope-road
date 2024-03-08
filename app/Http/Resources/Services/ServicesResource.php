<?php

namespace App\Http\Resources\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'active' => $this->active,
            'serviceInfo' => $this->serviceInfo == [] ? null : $this->serviceInfo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
