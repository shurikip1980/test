<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Order"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="user_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="first_name", type="string", maxLength=255, example="John"),
 * @OA\Property(property="last_name", type="string", maxLength=255, example="Doe"),
 * @OA\Property(property="middle_name", type="string", maxLength=255, example="Doese"),
 * @OA\Property(property="email", type="string", readOnly="true", format="email", description="User unique email address", example="user@gmail.com"),
 * @OA\Property(property="phone", type="string", maxLength=255, example="+380999999999"),
 * @OA\Property(property="region", type="string", maxLength=255, example="article"),
 * @OA\Property(property="city", type="string", maxLength=255, example="article"),
 * @OA\Property(property="department", type="string", example="article"),
 * @OA\Property(property="address", type="string", example="article"),
 * @OA\Property(property="delivery", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="payment", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="currency_sign", type="string", example="article"),
 * @OA\Property(property="status", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="total_cost", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="comment", type="string", example="article"),
 * @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
 * )
 *
 * Class Order
 *
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'phone',
        'region',
        'city',
        'department',
        'address',
        'delivery',
        'payment',
        'currency_sign',
        'status',
        'paid',
        'total_cost',
        'order_discount',
        'comment',
    ];

    /**
     * @return HasMany
     */
    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function statusOrder(): BelongsToMany
    {
        return $this->belongsToMany(Status::class, 'status_orders' );
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function userOrderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id')
            ->leftJoin('products', 'order_products.product_id', '=', 'products.id')
            ->leftJoin('product_langs', 'products.id', '=', 'product_langs.product_id')
            ->where('product_langs.lang', App::getLocale());
    }

    /**
     * @return HasMany
     */
    public function apiUserOrderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

}
