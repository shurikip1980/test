<?php


namespace App\View\Composers;


use App\Models\Icon;
use Illuminate\View\View;

class IconComposer
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
        $view->with('icons', Icon::defaultOrder()->get());
    }
}
