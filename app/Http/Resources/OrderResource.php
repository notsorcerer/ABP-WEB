<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'total' => (float) $this->total,
            'total_formatted' => 'Rp' . number_format($this->total, 0, ',', '.'),
            'payment_method' => $this->payment_method,
            'payment_method_label' => $this->payment_method_label,
            'payment_status' => $this->payment_status,
            'payment_status_label' => $this->payment_status_label,
            'shipping_name' => $this->shipping_name,
            'shipping_country' => $this->shipping_country,
            'shipping_province' => $this->shipping_province,
            'shipping_city' => $this->shipping_city,
            'shipping_district' => $this->shipping_district,
            'shipping_postal_code' => $this->shipping_postal_code,
            'shipping_address' => $this->shipping_address,
            'shipping_phone' => $this->shipping_phone,
            'shipping_email' => $this->shipping_email,
            'shipping_latitude' => (string) $this->shipping_latitude,
            'shipping_longitude' => (string) $this->shipping_longitude,
            'items' => OrderItemResource::collection($this->whenLoaded('items')),
            'items_count' => $this->whenLoaded('items', fn() => $this->items->count()),
            'created_at' => $this->created_at->toISOString(),
            'created_at_formatted' => $this->created_at->format('d M Y'),
        ];
    }
}
