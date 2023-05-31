<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusLang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'status_id',
        'lang',
        'name',
        'title'
    ];
}
