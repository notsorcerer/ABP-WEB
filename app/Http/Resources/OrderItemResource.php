<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'quantity' => $this->quantity,
            'price' => (float) $this->price,
            'price_formatted' => 'Rp' . number_format($this->price, 0, ',', '.'),
            'subtotal' => (float) $this->subtotal,
            'subtotal_formatted' => 'Rp' . number_format($this->subtotal, 0, ',', '.'),
        ];
    }
}
