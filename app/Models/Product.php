<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'is_best_seller',
        'is_new_arrival',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (Str::startsWith($this->image, 'http')) {
            return $this->image;
        }

        return Storage::disk('public')->url($this->image);
    }

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_best_seller' => 'boolean',
            'is_new_arrival' => 'boolean',
        ];
    }
}
