<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLang extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'lang',
        'name',
        'body',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
}
