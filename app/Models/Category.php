<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Kalnoy\Nestedset\NodeTrait;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Category"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="slug", type="string", maxLength=255, example="stiralnye-poroshki"),
 * @OA\Property(property="name", type="string", maxLength=255, example="Washing powders"),
 * @OA\Property(property="body", type="string", example="Washing powders"),
 * @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/categories/1656187120_o2dvsv2pnhe.jpg"),
 * @OA\Property(property="meta_title", type="string", maxLength=255, example="Washing powders"),
 * @OA\Property(property="meta_keywords", type="string", maxLength=255, example="Washing powders"),
 * @OA\Property(property="meta_description", type="string", example="Washing powders"),
 * )
 *
 * Class Category
 *
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        '_lft',
        '_rgt',
        'parent_id',
        'name',
        'slug',
        'image',
        'type_img',
        'show_main',
        'show_home',
        'constant',
        'active',
        'numeral',
    ];

    protected $appends = [
        'img'
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

    public function getImgAttribute()
    {
        return asset('storage/uploads/categories/'. $this->image . '.' . $this->type_img);
    }

    /**
     * @return HasMany
     */
    public function localizations(): HasMany
    {
        return $this->hasMany(CategoryLang::class);
    }

    /**
     * @return BelongsToMany
     */
    public function products(): belongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_category',
            'category_id',
            'product_id'
        );
    }

    public function apiProducts(): belongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_category',
            'category_id',
            'product_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function features(): belongsToMany
    {
        return $this->belongsToMany(Feature::class);
    }

    /**
     * @return BelongsToMany
     */
//    public function apiFeatures(): belongsToMany
//    {
//        return $this->belongsToMany(Feature::class)
//            ->leftJoin('feature_langs', 'feature_langs.feature_id', '=', 'features.id')
//            ->where('feature_langs.lang', App::getLocale())
//            ->where('features.show_main', 1)
//            ->select(
//                'features.id',
//                'feature_langs.name',
//            );
//    }
}
