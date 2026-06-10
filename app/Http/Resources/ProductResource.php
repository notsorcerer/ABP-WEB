<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => (float) $this->price,
            'price_formatted' => 'Rp' . number_format($this->price, 0, ',', '.'),
            'image_url' => $this->image_url,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ],
            'is_best_seller' => (bool) $this->is_best_seller,
            'is_new_arrival' => (bool) $this->is_new_arrival,
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
