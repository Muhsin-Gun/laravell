<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'status',
        'payment_status',
        'total_price',
        'mpesa_checkout_request_id',
        'mpesa_transaction_id'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_price' => 'decimal:2'
    ];

    // Status constants
    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    // Payment status constants
    public const PAYMENT_PENDING = 'pending';
    public const PAYMENT_COMPLETED = 'completed';
    public const PAYMENT_FAILED = 'failed';
    public const PAYMENT_REFUNDED = 'refunded';

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'order_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    // Helper methods
    public function isPaid(): bool
    {
        return $this->payment_status === self::PAYMENT_COMPLETED;
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isConfirmed(): bool
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }
}
