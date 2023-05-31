<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelLang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'label_id',
        'lang',
        'name',
    ];
}
