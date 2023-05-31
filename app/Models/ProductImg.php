<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImg extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'image',
        'type_img',
        'main_img',
        'numeral',
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

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
