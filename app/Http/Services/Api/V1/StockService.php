<?php


namespace App\Http\Services\Api\V1;


use App\Models\Stock;
use Illuminate\Support\Facades\App;

class StockService
{
    /**
     * @return array
     */
    public function getStocks($lang)
    {
        return Stock::select([
            'stocks.id',
            'stocks.image',
            'stocks.type_img',
            'stocks.slug',
            'stocks.created_at',
            'stock_langs.name',
            'stock_langs.short_body',
            'stock_langs.meta_title',
            'stock_langs.meta_keywords',
            'stock_langs.meta_description'
        ])
            ->leftJoin('stock_langs', 'stocks.id', '=', 'stock_langs.stock_id')
            ->where('stock_langs.lang', $lang ?? App::getLocale())
            ->where('stocks.show_main', 1)
            ->orderBy('stocks.created_at', 'DESC')
            ->paginate(2);
    }

    /**
     * @param $slug
     * @return Stock
     */
    public function getStock($lang, $slug): Stock
    {
        return Stock::Join('stock_langs', 'stock_langs.stock_id', '=', 'stocks.id')
            ->select(
                'stocks.id',
                'stocks.image',
                'stocks.type_img',
                'stocks.slug',
                'stocks.created_at',
                'stock_langs.name',
                'stock_langs.body',
                'stock_langs.meta_title',
                'stock_langs.meta_keywords',
                'stock_langs.meta_description'
            )
            ->where('stock_langs.lang', $lang ?? App::getLocale())
            ->where('stocks.slug', $slug)
            ->first();
    }

    /**
     * @return array
     */
    public function getHome($lang): array
    {
        return Stock::select([
            'stocks.id',
            'stocks.image',
            'stocks.type_img',
            'stocks.slug',
            'stocks.created_at',
            'stock_langs.name',
            'stock_langs.short_body',
            'stock_langs.meta_title',
            'stock_langs.meta_keywords',
            'stock_langs.meta_description'
        ])
            ->leftJoin('stock_langs', 'stocks.id', '=', 'stock_langs.stock_id')
            ->where('stock_langs.lang', $lang ?? App::getLocale())
            ->where('stocks.show_home', 1)
            ->limit(3)
            ->orderBy('stocks.created_at', 'DESC')
            ->get()->toArray();
    }
}
