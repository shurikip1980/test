<?php


namespace App\Http\Services\Api\V1;


use App\Models\Delivery;
use Illuminate\Support\Facades\App;

class DeliveryService
{
    /**
     * @return array
     */
    public function getDeliveries($lang): array
    {
        return Delivery::select([
            'deliveries.id',
            'delivery_langs.name',
        ])
            ->leftJoin('delivery_langs', 'deliveries.id', '=', 'delivery_langs.delivery_id')
            ->where('delivery_langs.lang', $lang ?? App::getLocale())
            ->get()->toArray();
    }
}
