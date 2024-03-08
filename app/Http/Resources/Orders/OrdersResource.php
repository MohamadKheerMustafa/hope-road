<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'service_id' => $this->service,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'phoneNumber' => $this->phoneNumber,
            'telephone' => $this->telephone,
            'notes' => $this->notes,
            'ipAddress' => $this->ipAddress,
            'user_id' => $this->user,
            'status' => $this->status,
            'employeeNotes' => $this->employeeNotes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
