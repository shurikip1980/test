<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Setting"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="name", type="string", maxLength=255, example="ENG"),
 * @OA\Property(property="img", type="string", maxLength=255, example="https://localhost:80/storage/uploads/logo/16614458741.png"),
 * @OA\Property(property="link", type="string", maxLength=255, example="https://www.youtube.com/"),
 * @OA\Property(property="time", type="integer", example="5"),
 * @OA\Property(property="map", type="string", maxLength=255, example="https://www.google.com/maps/place/Kropyvnytskyi+Tsentr+Reabilitatsiyi+Slukhu/@48.49463,32.2333777,13z/data=!4m5!3m4!1s0x40d0431400ceba33:0x4c3c1000c8e611e0!8m2!3d48.5022259!4d32.2347259"),
 * @OA\Property(property="email", type="string", maxLength=255, example="admin@gmail.com"),
 * @OA\Property(property="address", type="string", maxLength=255, example="Kyiv, Lesi Ukrainky street 12,"),
 * @OA\Property(property="site_name", type="string", maxLength=255, example="Test"),
 * @OA\Property(property="work", type="string", maxLength=255, example="Test"),
 * )
 *
 * Class Setting
 *
 */
class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'logo',
        'time',
        'email',
        'link',
        'map',
        'key_novaposhta',
        'date_novaposhta',
    ];
    protected $appends = [
      'img'
    ];

    /**
     * @return HasMany
     */
    public function localizations(): HasMany
    {
        return $this->hasMany(SettingLang::class);
    }

    public function getImgAttribute()
    {
        return asset('storage/uploads/logo/'. $this->logo);
    }

    /**
     * @return HasMany
     */
    public function phones(): HasMany
    {
        return$this->hasMany(Phone::class);
    }
}
