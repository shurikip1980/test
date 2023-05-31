<?php


namespace App\View\Composers;


use App\Models\Phone;
use Illuminate\View\View;

class PhoneComposer
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
        $view->with('phones', Phone::where('show_main', 1)->defaultOrder()->get());
    }
}
