<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'lang',
        'name',
        'specification',
        'short_body',
        'body',
        'characteristics',
        'shipping_payment',
        'info',
        'info_img',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

}
