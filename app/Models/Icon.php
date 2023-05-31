<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Icon"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", maxLength=255, example="ENG"),
 * @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/icons/1657500102_youtube.png"),
 * @OA\Property(property="link", type="string", maxLength=255, example="https://www.youtube.com/"),
 * )
 *
 * Class Icon
 *
 */
class Icon extends Model
{
    use HasFactory, NodeTrait;

    protected $fillable = [
        '_lft',
        '_rgt',
        'parent_id',
        'name',
        'image',
        'type_img',
        'link',
        'show_main'
    ];

    protected $appends = [
        'img'
    ];

    public function getImgAttribute()
    {
        return asset('storage/uploads/icons/'. $this->image.'.'.$this->type_img);
    }
}
