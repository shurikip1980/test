<?php


namespace App\View\Composers;


use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class CategoriesMenuComposer
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
        $categories_menu = Category::select([
            'categories.*',
            'category_langs.name'
        ])
            ->leftJoin('category_langs', 'categories.id', '=', 'category_langs.category_id')
            ->where('category_langs.lang', App::getLocale())
            ->where('categories.show_main', 1)
            ->where('categories.id', '!=', 8)
            ->where('categories.id', '!=', 9)
            ->where('categories.id', '!=', 10)
            ->defaultOrder()
            ->get();

        $view->with('categories_menu', $categories_menu);
    }
}
