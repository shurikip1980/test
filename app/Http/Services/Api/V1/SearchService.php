<?php


namespace App\Http\Services\Api\V1;


use App\Models\Product;
use Illuminate\Support\Facades\App;

class SearchService
{
    public function getProducts($lang, $search)
    {
        $search = trim(strip_tags($search));

        return Product::select(
            'products.id',
            'products.parent_id as parent',
            'products.slug',
            'products.code',
            'products.price',
            'products.price_old',
            'products.currency_id',
            'products.count_product',
            'product_langs.name'
        )
            ->Join('product_langs', 'products.id', '=', 'product_langs.product_id')
            ->join('currencies AS c1', 'products.currency_id', '=', 'c1.id')
            ->where('product_langs.lang', $lang ?? App::getLocale())
            ->where('products.show_main', 1)
            ->where('product_langs.name', 'like', '%' . $search . '%')
            ->with('img')
            ->get();
    }

}
