<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingLang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'setting_id',
        'lang',
        'address',
        'site_name',
        'text',
        'work',
    ];
}
