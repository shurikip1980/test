<?php


namespace App\Http\Services\Api\V1;


use App\Models\Slider;
use Illuminate\Support\Facades\App;

class SliderService
{
    public function getSliders($lang)
    {
       return Slider::select([
           'sliders.id',
           'sliders.image',
           'sliders.type_img',
           'sliders.link',
           'slider_langs.title',
           'slider_langs.name',
           'slider_langs.short_body'
       ])
           ->leftJoin('slider_langs', 'sliders.id', '=', 'slider_langs.slider_id')
           ->where('slider_langs.lang', $lang ?? App::getLocale())
           ->where('sliders.show_main', 1)
           ->defaultOrder()
           ->get()->toArray();
    }

}
