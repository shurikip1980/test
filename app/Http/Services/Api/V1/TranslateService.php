<?php


namespace App\Http\Services\Api\V1;


use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class TranslateService
{
    /**
     * @param $lang
     * @return array
     */
    public function getTranslate($langName): array
    {
        $langs = Language::where('status', 1)->get()->toArray();
        $langUI = $langName ?? App::getLocale();
        $my_arr = [];

        foreach ($langs as $lang) {
            if ($lang['lang'] === $langUI) {
                if (is_file(base_path('lang/' . $lang['lang'] . '/' . 'home.php'))) {
                    $my_arr = include base_path('lang/' . $lang['lang'] . '/' . 'home.php');
                }
            }
        }
        return $my_arr;
    }

}
