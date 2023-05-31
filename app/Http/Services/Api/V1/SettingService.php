<?php


namespace App\Http\Services\Api\V1;


use App\Models\Setting;
use Illuminate\Support\Facades\App;

class SettingService
{
    /**
     * @return Setting
     */
    public function getSettings($lang): Setting
    {
        return Setting::select(
            'settings.id',
            'settings.logo',
            'settings.time',
            'settings.link',
            'settings.map',
            'settings.email',
            'setting_langs.address',
            'setting_langs.site_name',
            'setting_langs.work',
        )
            ->leftJoin('setting_langs', 'settings.id', '=', 'setting_langs.setting_id')
            ->where('setting_langs.lang', $lang ?? App::getLocale())
            ->where('settings.id', 1)
            ->with('phones')
            ->first();
    }

}
