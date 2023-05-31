<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Slider"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", maxLength=255, example="ENG"),
 * @OA\Property(property="title", type="string", maxLength=255, example="Perfect it's clean"),
 * @OA\Property(property="short_body", type="string", maxLength=255, example="Choose what's best"),
 * @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/sliders/1661953758_2.jpg"),
 * @OA\Property(property="link", type="string", maxLength=255, example="https://www.youtube.com/"),
 * )
 *
 * Class Slider
 *
 */
class Slider extends Model
{
    use HasFactory, NodeTrait;

    protected $fillable = [
        '_lft',
        '_rgt',
        'parent_id',
        'link',
        'image',
        'type_img',
        'show_main',
    ];

    protected $appends = [
        'img'
    ];

    public function getImgAttribute()
    {
        return asset('storage/uploads/sliders/'. $this->image . '.' . $this->type_img);
    }

    /**
     * @return HasMany
     */
    public function localizations(): HasMany
    {
        return $this->hasMany(SliderLang::class);
    }
}
