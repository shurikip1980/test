<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'stock_id',
        'lang',
        'name',
        'short_body',
        'body',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
}
