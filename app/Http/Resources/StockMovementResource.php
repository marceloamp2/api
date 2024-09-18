<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockMovementResource extends JsonResource
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
            'type' => $this->type,
            'total_value' => $this->total_value,
            'nf_number' => $this->nf_number,
            'supplier_id' => $this->supplier_id,
            'inputs' => $this->inputs,
            'created_at' => $this->created_at->format('d/m/Y H:i'),
        ];
    }
}
