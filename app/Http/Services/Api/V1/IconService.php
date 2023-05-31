<?php


namespace App\Http\Services\Api\V1;


use App\Models\Icon;

class IconService
{
    /**
     * @return array
     */
    public function getIcons(): array
    {
        return Icon::select(
            'id',
            'name',
            'image',
            'type_img',
            'link'
        )->defaultOrder()->get()->toArray();
    }

}
