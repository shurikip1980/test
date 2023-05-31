<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Delivery"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", maxLength=255, example="Article"),
 * )
 *
 * Class Delivery
 *
 */
class Delivery extends Model
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
        return $this->hasMany(DeliveryLang::class);
    }
}
