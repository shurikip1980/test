<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Payment"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", maxLength=255, example="Article"),
 * )
 *
 * Class Payment
 *
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
    ];

    /**
     * @return HasMany
     */
    public function localizations(): HasMany
    {
        return $this->hasMany(PaymentLang::class);
    }
}
