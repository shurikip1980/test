<?php


namespace App\Http\Services\Api\V1;


use App\Models\Language;

class LanguageService
{
    /**
     * @return array
     */
    public function getLanguages(): array
    {
        return Language::select([
            'id',
            'name',
            'lang',
            'status',
            'default'
        ])->where('status', 1)->defaultOrder()->get()->toArray();
    }
}
