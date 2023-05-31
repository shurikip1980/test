<?php


namespace App\Http\Services\Api\V1;


use App\Models\Payment;
use Illuminate\Support\Facades\App;

class PaymentService
{
    /**
     * @return array
     */
    public function getPayments($lang): array
    {
        return Payment::select([
            'payments.id',
            'payment_langs.name',
        ])
            ->leftJoin('payment_langs', 'payments.id', '=', 'payment_langs.payment_id')
            ->where('payment_langs.lang', $lang ?? App::getLocale())
            ->get()->toArray();
    }
}
