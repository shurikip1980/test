<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;

class Label extends Model
{
    use HasFactory, NodeTrait;

    protected $fillable = [
        '_lft',
        '_rgt',
        'parent_id',
        'name',
        'slug',
        'name_title',
        'show_main',
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
                'source' => 'ru.name'
            ]
        ];
    }

    /**
     * @return BelongsToMany
     */
    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'status_orders', 'label_id', 'order_id');
    }

    /**
     * @return HasMany
     */
    public function orderLabel(): HasMany
    {
        return $this->hasMany(LabelOrder::class);
    }

    /**
     * @return HasMany
     */
    public function localizations(): HasMany
    {
        return $this->hasMany(LabelLang::class);
    }
}
