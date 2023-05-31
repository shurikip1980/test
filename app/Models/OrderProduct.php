<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProduct extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_code',
        'product_slug',
        'image',
        'type_img',
        'quantity',
        'cost',
    ];

    protected $appends = [
        'img',
        'nameImg'
    ];

    public function getImgAttribute()
    {
        return asset('storage/uploads/products/'. $this->image . '.' . $this->type_img);
    }

    public function getNameImgAttribute()
    {
        return asset('storage/uploads/products/'. $this->image);
    }

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return$this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return$this->belongsTo(Product::class);
    }
}
