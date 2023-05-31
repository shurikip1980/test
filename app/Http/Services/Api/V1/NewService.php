<?php


namespace App\Http\Services\Api\V1;


use App\Models\News;
use Illuminate\Support\Facades\App;

class NewService
{
    /**
     * @return array
     */
    public function getNews($lang): array
    {
        return News::select([
            'news.id',
            'news.image',
            'news.type_img',
            'news.slug',
            'news.created_at',
            'new_langs.name',
            'new_langs.short_body',
            'new_langs.meta_title',
            'new_langs.meta_keywords',
            'new_langs.meta_description'
        ])
            ->leftJoin('new_langs', 'news.id', '=', 'new_langs.news_id')
            ->where('new_langs.lang', $lang ?? App::getLocale())
            ->where('news.show_main', 1)
            ->orderBy('news.created_at', 'DESC')
            ->get()->toArray();
    }

    /**
     * @param $slug
     * @return News
     */
    public function getNew($lang, $slug): News
    {
        return News::select(
            'news.id',
            'news.image',
            'news.type_img',
            'news.slug',
            'news.created_at',
            'new_langs.name',
            'new_langs.body',
            'new_langs.meta_title',
            'new_langs.meta_keywords',
            'new_langs.meta_description'
        )
            ->Join('new_langs', 'new_langs.news_id', '=', 'news.id')
            ->where('new_langs.lang', $lang ?? App::getLocale())
            ->where('news.slug', $slug)
            ->first();
    }

    /**
     * @return array
     */
    public function getHome($lang): array
    {
        return News::select([
            'news.id',
            'news.image',
            'news.type_img',
            'news.slug',
            'news.created_at',
            'new_langs.name',
            'new_langs.short_body',
            'new_langs.meta_title',
            'new_langs.meta_keywords',
            'new_langs.meta_description'
        ])
            ->leftJoin('new_langs', 'news.id', '=', 'new_langs.news_id')
            ->where('new_langs.lang', $lang ?? App::getLocale())
            ->where('news.show_home', 1)
            ->limit(3)
            ->orderBy('news.created_at', 'DESC')
            ->get()->toArray();
    }
}
