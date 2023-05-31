<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Language"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", maxLength=255, example="ENG"),
 * @OA\Property(property="lang", type="string", maxLength=255, example="en"),
 * @OA\Property(property="status", type="boolean", example="true"),
 * @OA\Property(property="default", type="boolean", example="true"),
 * )
 *
 * Class Language
 *
 */
class Language extends Model
{
    use HasFactory, NodeTrait;

    protected $fillable = [
        '_lft',
        '_rgt',
        'parent_id',
        'name',
        'lang',
        'status',
        'default',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
        'default' => 'boolean'
    ];
}
