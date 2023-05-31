<?php

namespace App\View\Composers;

use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class SettingComposer
{
    /**
     * CallbackComposer constructor.
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $settings = Setting::select(
            'settings.*',
            'setting_langs.lang',
            'setting_langs.text',
            'setting_langs.work',
            'setting_langs.address'
        )
            ->leftJoin('setting_langs', 'settings.id', '=', 'setting_langs.setting_id')
            ->where('setting_langs.lang', App::getLocale())
            ->first();
        $view->with('settings', $settings);
    }
}
