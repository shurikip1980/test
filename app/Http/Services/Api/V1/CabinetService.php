<?php


namespace App\Http\Services\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\App;


class CabinetService extends Controller
{
    private $lang;
    /**
     * @param $id
     * @return array
     */
    public function getOrders($lang, $id)
    {
        $this->lang = $lang;
        return Order::select([
            'orders.id',
            'orders.first_name',
            'orders.last_name',
            'orders.middle_name',
            'orders.email',
            'orders.phone',
            'orders.region',
            'orders.total_cost',
            'orders.created_at',
        ])
            ->where('orders.user_id', $id)
            ->with(['statusOrder' => function ($q) {
                $q->Join('status_langs', 'statuses.id', '=', 'status_langs.status_id');
                $q->where('status_langs.lang', $this->lang ?? App::getLocale());
                $q->select(
                    'statuses.id',
                    'status_langs.name',
                    'status_langs.title',
                );
            }])
            ->with(['apiUserOrderProducts' => function ($q) {
                $q->Join('products', 'order_products.product_id', '=', 'products.id');
                $q->Join('product_langs', 'products.id', '=', 'product_langs.product_id');
                $q->where('product_langs.lang', $this->lang ?? App::getLocale());
//                $q->select(
//                    'products.id',
//                    'products.slug',
//                    'product_langs.name',
//                    'products.code',
//                    'products.price',
//                    'products.price_old',
//                    'products.count_product',
//                    'order_products.id',
//                    'order_products.order_id',
//                    'order_products.quantity',
//                    'order_products.cost',
//                );
            }])
            ->orderBy('orders.created_at', 'desc')
            ->get();
    }


    /**
     * @param $user
     * @return User
     */
    public function updateUser($user): User
    {
        User::where('id', $user['id'])->update([
            'first_name' => $user['first_name'] ?? '',
            'last_name' => $user['last_name'] ?? '',
            'middle_name' => $user['middle_name'] ?? '',
            'email' => $user['email'],
            'phone' => $user['phone'] ?? ''
        ]);

        return User::where('id', $user['id'])->select([
            'id',
            'first_name',
            'last_name',
            'middle_name',
            'email',
            'phone',
        ])->first();
    }
}
