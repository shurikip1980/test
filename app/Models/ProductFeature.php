<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    use HasFactory;

    protected $table = 'product_feature';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'feature_id'
    ];
}
