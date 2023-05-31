<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderLang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'slider_id',
        'lang',
        'name',
        'title',
        'short_body',
    ];
}
