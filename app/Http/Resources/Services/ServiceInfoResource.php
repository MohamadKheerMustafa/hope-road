<?php

namespace App\Http\Resources\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceInfoResource extends JsonResource
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
            'country' => $this->country,
            'durationOfCompletion' => $this->durationOfCompletion,
            'serviceValidityPeriod' => $this->serviceValidityPeriod,
            'details' => $this->details,
            'price' => $this->price,
            'requiredPapers' => $this->requiredPapers,
            'paymentPrice' => $this->paymentPrice,
            'entity' => $this->entity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
