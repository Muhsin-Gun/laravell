<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'checkout_request_id',
        'merchant_request_id',
        'mpesa_receipt_number',
        'phone_number',
        'amount',
        'status',
        'result_code',
        'result_description',
        'transaction_date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'order_id');
    }
}
