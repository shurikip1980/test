<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureLang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'feature_id',
        'lang',
        'name',
    ];
}
