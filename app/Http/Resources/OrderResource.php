<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'total_value' => $this->total_value,
            'sedex' => $this->sedex,
            'discount' => $this->discount,
            'note' => $this->note,
            'status' => $this->status,
            'customer' => $this->customer,
            'company' => $this->company,
            'payment_method' => $this->paymentMethod,
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'projects' => $this->projects
        ];
    }
}
