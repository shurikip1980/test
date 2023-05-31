<?php


namespace App\View\Composers;


use App\Models\Page;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class PageComposer
{
    /**
     * CallbackComposer constructor.
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $query = Page::select(
            'pages.*',
            'page_langs.name',
            'page_langs.short_body',
            'page_langs.body',
        )
            ->Join('page_langs', 'page_langs.page_id', '=', 'pages.id')
            ->where('page_langs.lang', App::getLocale())
            ->where('pages.active', 1)
            ->whereIn('pages.type', ['main', 'footer'])
            ->defaultOrder()
            ->get();

        $pages = $query->where('type', 'main');
        $footer_pages = $query->where('type', 'footer')->toArray();

        $view->with('pages', $pages);
        $view->with('footer_pages', array_chunk($footer_pages, 4));
    }
}
