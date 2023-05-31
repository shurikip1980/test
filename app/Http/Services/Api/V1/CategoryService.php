<?php

namespace App\Http\Services\Api\V1;

use App\Models\Category;
use App\Models\Feature;
use App\Models\ProductCategory;
use App\Models\ProductFeature;
use Illuminate\Support\Facades\App;

class CategoryService
{
    private $lang;

    /**
     * @param $lang
     * @return array
     */
    public function index($lang): array
    {
        return Category::select([
            'categories.id',
            'categories.slug',
            'categories.image',
            'categories.type_img',
            'category_langs.name'
        ])
            ->leftJoin('category_langs', 'categories.id', '=', 'category_langs.category_id')
            ->where('category_langs.lang', $lang ?? App::getLocale())
            ->where('categories.show_main', 1)
            ->defaultOrder()
            ->get()->toArray();
    }


    /**
     * @param $lang
     * @param $slug
     * @return Category
     */
    public function show($lang, $slug): Category
    {
        $this->lang = $lang;
        return Category::select([
            'categories.id',
            'categories.slug',
            'categories.image',
            'categories.type_img',
            'category_langs.name',
            'category_langs.body',
            'category_langs.meta_title',
            'category_langs.meta_keywords',
            'category_langs.meta_description',

        ])
            ->leftJoin('category_langs', 'categories.id', '=', 'category_langs.category_id')
            ->where('category_langs.lang', $lang ?? App::getLocale())
            ->where('categories.slug', $slug)
            ->with(['apiProducts' => function ($q) {
                $q->Join('product_langs', 'products.id', '=', 'product_langs.product_id');
                $q->where('product_langs.lang', $this->lang ?? App::getLocale());
                $q->where('products.show_main', 1);
                $q->with('img');
                $q->with('comments');
                $q->with(['features' => function ($q) {
                    $q->Join('feature_langs', 'feature_langs.feature_id', '=', 'features.id');
                    $q->where('feature_langs.lang', $this->lang ?? App::getLocale());
                    $q->select(
                        'features.id',
                        'feature_langs.name',
                    );
                }]);
                $q->select(
                    'products.id',
                    'products.slug',
                    'products.code',
                    'products.price',
                    'products.price_old',
                    'products.count_product',
                    'products.price_old',
                    'product_langs.name',
                );
            }])->first();
    }


    /**
     * @param $lang
     * @param $id
     * @return Category
     */
    public function getHomeProducts($lang, $id): Category
    {
        $this->lang = $lang;
        return Category::select([
            'categories.id',
            'categories.slug',
            'categories.image',
            'categories.type_img',
            'category_langs.name',
            'category_langs.body',
            'category_langs.meta_title',
            'category_langs.meta_keywords',
            'category_langs.meta_description',

        ])
            ->leftJoin('category_langs', 'categories.id', '=', 'category_langs.category_id')
            ->where('category_langs.lang', $lang ?? App::getLocale())
            ->where('categories.id', $id)
            ->with(['apiProducts' => function ($q) {
                $q->Join('product_langs', 'products.id', '=', 'product_langs.product_id');
                $q->where('product_langs.lang', $this->lang ?? App::getLocale());
                $q->where('products.show_main', 1);
                $q->with('img');
                $q->with('comments');
                $q->with(['features' => function ($q) {
                    $q->Join('feature_langs', 'feature_langs.feature_id', '=', 'features.id');
                    $q->where('feature_langs.lang', $this->lang ?? App::getLocale());
                    $q->select(
                        'features.id',
                        'feature_langs.name',
                    );
                }]);
                $q->select(
                    'products.id',
                    'products.slug',
                    'products.code',
                    'products.price',
                    'products.price_old',
                    'products.count_product',
                    'products.price_old',
                    'product_langs.info_img',
                    'product_langs.name',
                );
            }])->first();
    }


    /**
     * @param $lang
     * @return array
     */
    public function home($lang): array
    {
        return Category::select([
            'categories.id',
            'categories.slug',
            'categories.image',
            'categories.type_img',
            'category_langs.name'
        ])
            ->leftJoin('category_langs', 'categories.id', '=', 'category_langs.category_id')
            ->where('category_langs.lang', $lang ?? App::getLocale())
            ->where('categories.show_main', 1)
            ->where('categories.id', '!=', 8)
            ->where('categories.id', '!=', 9)
            ->where('categories.id', '!=', 10)
            ->defaultOrder()
            ->get()->toArray();
    }

    /**
     * @param $lang
     * @param $id
     * @return mixed
     */
    public function getFeatures($lang, $id): mixed
    {
        $products_id = ProductCategory::where('category_id', $id)->pluck('product_id');

        $featuresIds = ProductFeature::whereIn('product_id', $products_id)
            ->leftJoin('features', 'features.id', '=', 'product_feature.feature_id')
            ->select('features.id')
            ->pluck('id')
            ->toArray();

        $parentIds = Feature::whereIn('id', array_unique($featuresIds))->get()->pluck('parent_id')->toArray();

        return Feature::leftJoin('feature_langs', 'feature_langs.feature_id', '=', 'features.id')
            ->where('feature_langs.lang', $lang ?? App::getLocale())
            ->where('show_main', 1)
            ->whereIn('features.id', array_unique(array_merge($parentIds, $featuresIds)))
            ->select(
                'features.*',
                'feature_langs.name',
            )
            ->defaultOrder()
            ->get()->toTree();
    }
}
