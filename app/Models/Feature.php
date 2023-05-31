<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Kalnoy\Nestedset\NodeTrait;

class Feature extends Model
{
    use HasFactory, NodeTrait;

    protected $fillable = [
        '_lft',
        '_rgt',
        'parent_id',
        'show_main',
    ];


    /**
     * @return HasMany
     */
    public function localizations(): HasMany
    {
        return $this->hasMany(FeatureLang::class);
    }

    public function childrens(){
        return $this->hasMany('App\Models\Feature','parent_id','id')
            ->Join('feature_langs','feature_langs.feature_id','=','features.id')
            ->where('feature_langs.lang','=', App::getLocale())
            ->select('features.*','feature_langs.name');
    }
}
