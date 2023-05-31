<?php


namespace App\Http\Services\Api\V1;


use App\Models\Page;
use Illuminate\Support\Facades\App;

class PageService
{

    /**
     * @param $type
     * @param $lang
     * @return array
     */
    public function index($type, $lang): array
    {
        return Page::select(
            'pages.id',
            'pages.parent_id as parent',
            'pages.slug',
            'page_langs.name',
        )
            ->Join('page_langs', 'page_langs.page_id', '=', 'pages.id')
            ->where('page_langs.lang', $lang ?? App::getLocale())
            ->where('pages.active', 1)
            ->where('type', $type)
            ->defaultOrder()
            ->get()
            ->toArray();
    }


    /**
     * @param $lang
     * @param $slug
     * @return Page
     */
    public function show($lang, $slug): Page
    {
        return Page::select(
            'pages.id',
            'pages.parent_id as parent',
            'pages.slug',
            'pages.image',
            'page_langs.name',
            'page_langs.body',
            'page_langs.meta_title',
            'page_langs.meta_keywords',
            'page_langs.meta_description'
        )
            ->Join('page_langs', 'page_langs.page_id', '=', 'pages.id')
            ->where('page_langs.lang', $lang ?? App::getLocale())
            ->where('pages.slug', $slug)
            ->first();
    }


    /**
     * @param $lang
     * @return Page
     */
    public function home($lang): Page
    {
        return Page::select(
            'pages.id',
            'pages.parent_id as parent',
            'pages.slug',
            'pages.image',
            'page_langs.name',
            'page_langs.body',
            'page_langs.meta_title',
            'page_langs.meta_keywords',
            'page_langs.meta_description'
        )
            ->Join('page_langs', 'page_langs.page_id', '=', 'pages.id')
            ->where('page_langs.lang', $lang ?? App::getLocale())
            ->where('pages.slug', '/')
            ->first();
    }
}
