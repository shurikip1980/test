<?php

namespace App\View\Composers;

use App\Models\Language;
use Illuminate\View\View;

class LanguageComposer
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
        $view->with('languages', Language::where('status', 1)->defaultOrder()->get());
    }
}
