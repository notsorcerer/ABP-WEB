<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'shipping_name',
        'shipping_country',
        'shipping_province',
        'shipping_city',
        'shipping_district',
        'shipping_postal_code',
        'shipping_address',
        'shipping_phone',
        'shipping_email',
        'shipping_latitude',
        'shipping_longitude',
        'payment_method',
        'payment_status',
        'total',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        return match ($this->payment_method) {
            'bank_transfer' => 'Transfer Bank',
            'ewallet' => 'E-Wallet',
            'qr_code' => 'QR Code (QRIS)',
            'cod' => 'COD (Bayar di Tempat)',
            default => ucfirst(str_replace('_', ' ', $this->payment_method)),
        };
    }

    public function getPaymentStatusLabelAttribute(): string
    {
        return match ($this->payment_status) {
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Lunas',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($this->payment_status),
        };
    }
}
