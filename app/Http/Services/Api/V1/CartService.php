<?php


namespace App\Http\Services\Api\V1;


use App\Models\LabelOrder;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\StatusOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartService
{
    /**
     * @param $productsId
     * @return array
     */
    public function getCartProducts($productsId, $lang = null): array
    {
        if ($productsId) {
            $productsArray = [];

            foreach ($productsId as $item) {
                $productsArray[] = $item['id'];
            }

            $products = Product::select([
                'products.id',
                'products.slug',
                'product_langs.name',
                'products.code',
                'products.price',
                'products.price_old',
                'products.count_product',
                'products.price_old',
            ])
                ->leftJoin('product_langs', 'products.id', '=', 'product_langs.product_id')
                ->where('product_langs.lang', $lang ?? App::getLocale())
                ->with('img')
                ->with('currency')
                ->whereIn('products.id', $productsArray)
                ->get()->toArray();

            foreach ($products as $key => $product) {
                foreach ($productsId as $item) {
                    if ($product['id'] === $item['id']) {
                        $products[$key]['num'] = $item['num'];
                    }
                }

            }
            return $products;
        }

        return [];
    }

    public function addOrder($request)
    {
        $form = $request->get('form');
        $products = $request->get('products');
        $user = $request->get('user');

        $totalPrice = 0;
        $products = $this->getCartProducts($products);

        $insert = [
            'user_id' => $user['id'],
            'first_name' => $form['first_name'],
            'last_name' => $form['last_name'],
            'middle_name' => $form['middle_name'],
            'email' => $form['email'],
            'phone' => $form['phone'],
            'region' => $form['region'],
            'city' => $form['city'],
            'department' => $form['department'],
            'address' => $form['address'],
            'comment' => $form['comment'] ?? '',
            'delivery' => $form['delivery'],
            'payment' => $form['payment'],
            'status' => 1,
        ];

        $order = Order::create(array_merge($insert));

        foreach ($products as $product) {
            $totalPrice += ($product['price'] * $product['num']);
            $productsInsert = [
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'product_name' => $product['name'],
                'product_code' => $product['code'],
                'quantity' => $product['num'],
                'product_slug' => $product['slug'],
                'cost' => $product['price'],
                'image' => $product['img'][0]['image'],
                'type_img' => $product['img'][0]['type_img']
            ];
            OrderProduct::create(array_merge($productsInsert));
        }

        Order::where('id', $order->id)->update(['total_cost' => $totalPrice]);

        StatusOrder::create([
            'order_id' => $order->id,
            'status_id' => 1
        ]);

        LabelOrder::create([
            'order_id' => $order->id,
            'label_id' => 1
        ]);

        return true;
    }
}
