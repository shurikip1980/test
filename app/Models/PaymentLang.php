<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentLang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'payment_id',
        'name',
        'lang',
    ];

    /**
     * @return BelongsTo
     */
    public function getPayment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
