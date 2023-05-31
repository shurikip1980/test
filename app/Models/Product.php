<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;
use Kalnoy\Nestedset\NodeTrait;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Product"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="slug", type="string", maxLength=255, example="stiralnyj-poroshok-dlya-novorozhdennyh-2kg"),
 * @OA\Property(property="name", type="string", maxLength=255, example="Laundry detergent for newborns, 2kg"),
 * @OA\Property(property="code", type="string", example="2542"),
 * @OA\Property(property="price", type="integer", readOnly="true", example="30.00"),
 * @OA\Property(property="price_old", type="integer", readOnly="true", example="0.00"),
 * @OA\Property(property="count_product", type="integer", readOnly="true", example="56"),
 * @OA\Property(property="short_body", type="string", example="Washing powders"),
 * @OA\Property(property="body", type="string", example="Washing powders"),
 * @OA\Property(property="info", type="string", example="Washing powders"),
 * @OA\Property(property="alike", type="string", example="name value"),
 * @OA\Property(property="specification", type="string", example="name value"),
 * @OA\Property(property="shipping_payment", type="string", example="Washing powders"),
 * @OA\Property(property="meta_title", type="string", maxLength=255, example="Washing powders"),
 * @OA\Property(property="meta_keywords", type="string", maxLength=255, example="Washing powders"),
 * @OA\Property(property="meta_description", type="string", example="Washing powders"),
 * )
 *
 * Class Product
 *
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        '_lft',
        '_rgt',
        'parent_id',
        'slug',
        'code',
        'show_main',
        'popular',
        'in_stock',
        'new',
        'stock',
        'price',
        'price_old',
        'currency_id',
        'count_product',
        'alike',
        'delivery',
    ];

    use Sluggable, NodeTrait {
        NodeTrait::replicate as replicateNode;
        Sluggable::replicate as replicateSlug;
    }

    public function replicate(array $except = null)
    {
        $instance = $this->replicateNode($except);
        (new SlugService())->slug($instance, true);

        return $instance;
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'ru.name'
            ]
        ];
    }

    /**
     * @return HasMany
     */
    public function localizations(): HasMany
    {
        return $this->hasMany(ProductLang::class);
    }

    /**
     * @return BelongsToMany
     */
    public function category(): belongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    /**
     * @return HasMany
     */
    public function imgAdmin(): HasMany
    {
        return $this->hasMany(ProductImg::class);
    }

    /**
     * @return HasMany
     */
    public function imgOneProduct(): HasMany
    {
        return $this->hasMany(ProductImg::class)
            ->where('product_imgs.main_img', 1)
            ->where('product_imgs.numeral', 1);
    }

    /**
     * @return HasMany
     */
    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * @return HasOne
     */
    public function currency(): HasOne
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(ProductComment::class, 'product_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function img(): HasMany
    {
        return $this->hasMany(ProductImg::class, 'product_id', 'id')
            ->select(
                'product_imgs.id',
                'product_imgs.image',
                'product_imgs.type_img',
                'product_imgs.product_id',
                'product_imgs.main_img',
                'product_imgs.numeral'
            )
            ->where('product_imgs.main_img', 1)
            ->orderBy('product_imgs.numeral', 'asc');
    }

    /**
     * @return BelongsToMany
     */
    public function features(): belongsToMany
    {
        return $this->belongsToMany(Feature::class, 'product_feature', 'product_id', 'feature_id');
    }
}
