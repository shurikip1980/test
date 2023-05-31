<?php


namespace App\View\Composers;


use App\Models\StatusOrder;
use Illuminate\View\View;

class OrderComposer
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
        $statusOrder = StatusOrder::all();
        $view->with('new_orders', $statusOrder->where('status_id', 1)->count());
        $view->with('accept_orders', $statusOrder->where('status_id', 2)->count());
        $view->with('closed_orders', $statusOrder->where('status_id', 3)->count());
        $view->with('canceled_orders', $statusOrder->where('status_id', 4)->count());
    }
}
