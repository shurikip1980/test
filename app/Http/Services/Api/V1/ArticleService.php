<?php


namespace App\Http\Services\Api\V1;


use App\Models\Article;
use Illuminate\Support\Facades\App;

class ArticleService
{

    /**
     * @return array
     */
    public function getArticles($lang): array
    {
        return Article::select([
            'articles.id',
            'articles.image',
            'articles.type_img',
            'articles.slug',
            'articles.created_at',
            'article_langs.name',
            'article_langs.short_body',
            'article_langs.meta_title',
            'article_langs.meta_keywords',
            'article_langs.meta_description'
        ])
            ->leftJoin('article_langs', 'articles.id', '=', 'article_langs.article_id')
            ->where('article_langs.lang', $lang ?? App::getLocale())
            ->where('articles.show_main', 1)
            ->orderBy('articles.created_at', 'DESC')
            ->get()->toArray();
    }

    /**
     * @param $slug
     * @return Article
     */
    public function getArticle($lang, $slug): Article
    {
        return Article::select(
            'articles.id',
            'articles.image',
            'articles.type_img',
            'articles.slug',
            'articles.created_at',
            'article_langs.name',
            'article_langs.body',
            'article_langs.meta_title',
            'article_langs.meta_keywords',
            'article_langs.meta_description'
        )
            ->leftJoin('article_langs', 'article_langs.article_id', '=', 'articles.id')
            ->where('article_langs.lang', $lang ?? App::getLocale())
            ->where('articles.slug', $slug)
            ->first();
    }

    /**
     * @return array
     */
    public function getHome($lang): array
    {
        return Article::select([
            'articles.id',
            'articles.image',
            'articles.type_img',
            'articles.slug',
            'articles.created_at',
            'article_langs.name',
            'article_langs.short_body',
            'article_langs.meta_title',
            'article_langs.meta_keywords',
            'article_langs.meta_description'
        ])
            ->leftJoin('article_langs', 'articles.id', '=', 'article_langs.article_id')
            ->where('article_langs.lang', $lang ?? App::getLocale())
            ->where('articles.show_home', 1)
            ->limit(3)
            ->orderBy('articles.created_at', 'DESC')
            ->get()->toArray();
    }

}
