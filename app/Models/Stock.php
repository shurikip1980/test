<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Stock"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="slug", type="string", maxLength=255, example="article"),
 * @OA\Property(property="name", type="string", maxLength=255, example="Article"),
 * @OA\Property(property="short_body", type="string", example="article"),
 * @OA\Property(property="body", type="string", example="article"),
 * @OA\Property(property="nameImg", type="string", maxLength=255, example="https://localhost:80/storage/uploads/articles/1661447186_coollogo_com-9344724"),
 * @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/articles/1661447186_coollogo_com-9344724.jpg"),
 * @OA\Property(property="meta_title", type="string", maxLength=255, example="article"),
 * @OA\Property(property="meta_keywords", type="string", maxLength=255, example="article"),
 * @OA\Property(property="meta_description", type="string", example="article"),
 * @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
 * )
 *
 * Class Stock
 *
 */
class Stock extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'stock_id',
        'image',
        'type_img',
        'slug',
        'show_main',
        'show_home',
        'status',
    ];

    protected $appends = [
        'img',
        'nameImg'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'en.name'
            ]
        ];
    }

    public function getImgAttribute()
    {
        return asset('storage/uploads/stocks/'. $this->image . '.' . $this->type_img);
    }

    public function getNameImgAttribute()
    {
        return asset('storage/uploads/stocks/'. $this->image);
    }

    /**
     * @return HasMany
     */
    public function localizations(): HasMany
    {
        return $this->hasMany(StockLang::class);
    }
}
