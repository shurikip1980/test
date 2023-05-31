<?php


namespace App\Http\Services\Api\V1;


use App\Models\Product;
use App\Models\ProductComment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;

class ProductService
{
    private $lang;
    /**
     * @return array
     */
    public function getProducts(): array
    {
        return Product::select([
            'products.id',
            'products.slug',
            'products.code',
            'products.price',
            'products.price_old',
            'products.count_product',
            'products.price_old',
            'product_langs.name',
            'product_langs.short_body',
            'product_langs.meta_title',
            'product_langs.meta_keywords',
            'product_langs.meta_description',
        ])
            ->leftJoin('product_langs', 'products.id', '=', 'product_langs.product_id')
            ->where('product_langs.lang', App::getLocale())
            ->with('category')
            ->with('img')
            ->with('comments')
            ->get()
            ->toArray();
    }


    /**
     * @param $lang
     * @param $slug
     * @return Product
     */
    public function getProduct($lang, $slug): Product
    {
        $this->lang = $lang;
        $product = Product::select([
            'products.id',
            'products.slug',
            'product_langs.name',
            'products.code',
            'products.price',
            'products.price_old',
            'products.count_product',
            'product_langs.short_body',
            'product_langs.body',
            'product_langs.info',
            'product_langs.shipping_payment',
            'product_langs.meta_title',
            'product_langs.meta_keywords',
            'product_langs.meta_description',
            'products.alike',
            'product_langs.specification',
        ])
            ->leftJoin('product_langs', 'products.id', '=', 'product_langs.product_id')
            ->where('product_langs.lang', $lang ?? App::getLocale())
            ->where('products.slug', $slug)
            ->with(['category' => function ($q) {
                $q->Join('category_langs', 'categories.id', '=', 'category_langs.category_id');
                $q->where('category_langs.lang', $this->lang ?? App::getLocale());
                $q->select(
                    'categories.id',
                    'category_langs.name',
                    'categories.slug',
                );
            }])
            ->with('img')
            ->with('comments')
            ->first();

        if ($product->alike) {
            $product->alike = $this->getAlikeProducts(unserialize($product->alike));
        }

        $product->specification = unserialize($product->specification);

        return $product;
    }


    public function getAlikeProducts($alike)
    {
        return Product::select([
            'products.id',
            'products.slug',
            'product_langs.name',
            'products.code',
            'products.price',
            'products.price_old',
            'products.count_product',
            'product_langs.short_body',
            'product_langs.info_img',
        ])
            ->whereIn('products.id', $alike)
            ->leftJoin('product_langs', 'products.id', '=', 'product_langs.product_id')
            ->where('product_langs.lang', $this->lang ?? App::getLocale())
            ->where('products.show_main', 1)
            ->with('img')
            ->with('comments')
            ->get();
    }

    public function addComment($id, $commentRequest)
    {
        $forms = $commentRequest->get('forms');
//        $productId = $commentRequest->get('productId');
        $this->lang = $commentRequest->get('lang');

        ProductComment::create([
            'product_id' => $id,
            'name' => $forms['name'],
            'email' => $forms['email'],
            'text' => $forms['text'],
        ]);

        $product = Product::select([
            'products.id',
            'products.slug',
            'product_langs.name',
            'products.code',
            'products.price',
            'products.price_old',
            'products.count_product',
            'product_langs.short_body',
            'product_langs.body',
            'product_langs.info',
            'product_langs.shipping_payment',
            'product_langs.meta_title',
            'product_langs.meta_keywords',
            'product_langs.meta_description',
            'products.alike',
            'product_langs.specification',
        ])
            ->leftJoin('product_langs', 'products.id', '=', 'product_langs.product_id')
            ->where('product_langs.lang', $this->lang ?? App::getLocale())
            ->where('products.id', $id)
            ->with(['category' => function ($q) {
                $q->Join('category_langs', 'categories.id', '=', 'category_langs.category_id');
                $q->where('category_langs.lang', $this->lang ?? App::getLocale());
                $q->select(
                    'categories.id',
                    'category_langs.name',
                    'categories.slug',
                );
            }])
            ->with('img')
            ->with('comments')
            ->first();

        if ($product->alike) {
            $product->alike = $this->getAlikeProducts(unserialize($product->alike));
        }

        $product->specification = unserialize($product->specification);

        return $product;
    }

}
