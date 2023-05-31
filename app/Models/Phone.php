<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Phone extends Model
{
    use HasFactory, NodeTrait;

    public $timestamps = false;

    protected $fillable = [
        '_lft',
        '_rgt',
        'parent_id',
        'setting_id',
        'phone',
        'show_main'
    ];
}
