<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'customer_id',
        'created_by',
        'weight_kg',
        'service',
        'status',
        'price_per_kg',
        'total_price',
        'notes',
        'estimated_done',
        'picked_up_at',
        'delivery_option',
    ];

    protected $casts = [
        'weight_kg'      => 'decimal:2',
        'price_per_kg'   => 'decimal:2',
        'total_price'    => 'decimal:2',
        'estimated_done' => 'date',
        'picked_up_at'   => 'datetime',
    ];

    // Price map per kg (IDR)
    public const PRICE_MAP = [
        'cuci_kering'  => 6000,
        'cuci_setrika' => 8000,
        'express'      => 12000,
    ];

    public const SERVICE_LABELS = [
        'cuci_kering'  => 'Cuci + Kering',
        'cuci_setrika' => 'Cuci + Setrika',
        'express'      => 'Express',
    ];

    public const STATUS_LABELS = [
        'pending' => 'Menunggu',
        'washing' => 'Dicuci',
        'done'    => 'Selesai',
        'pickup'  => 'Diambil',
    ];

    public const STATUS_FLOW = ['pending', 'washing', 'done', 'pickup'];

    // Relationships
    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function creator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function statusLogs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderStatusLog::class)->orderBy('changed_at');
    }

    // Helpers
    public static function generateCode(): string
    {
        return 'RNS-' . strtoupper(substr(uniqid(), -8));
    }

    public static function calcTotal(float $weight, string $service): float
    {
        return $weight * (self::PRICE_MAP[$service] ?? 0);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    public function getServiceLabelAttribute(): string
    {
        return self::SERVICE_LABELS[$this->service] ?? $this->service;
    }

    public function isPickedUp(): bool
    {
        return $this->status === 'pickup';
    }
}
