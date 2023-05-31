<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Page"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="slug", type="string", maxLength=255, example="o-nas"),
 * @OA\Property(property="image", type="string", maxLength=255, example="https://localhost:80/storage/uploads/pages/16614458741.png"),
 * @OA\Property(property="name", type="string", maxLength=255, example="About Us"),
 * @OA\Property(property="body", type="string", example="About Us"),
 * @OA\Property(property="meta_title", type="string", maxLength=255, example="About Us"),
 * @OA\Property(property="meta_keywords", type="string", maxLength=255, example="About Us"),
 * @OA\Property(property="meta_description", type="string", example="About Us"),
 * )
 *
 * Class Page
 *
 */
class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        '_lft',
        '_rgt',
        'parent_id',
        'slug',
        'image',
        'type',
        'active',
    ];

    use Sluggable , NodeTrait {
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
                'source' => 'en.name'
            ]
        ];
    }

    /**
     * @return HasMany
     */
    public function localizations(): HasMany
    {
        return $this->hasMany(PageLang::class);
    }
}
