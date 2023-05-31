<?php


namespace App\View\Composers;

use App\Models\Callback;
use Illuminate\View\View;

class CallbackComposer
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
        $view->with('callback', Callback::where('status', 0)->get()->count());
    }
}
