<?php

namespace App\Providers;

use App\View\Composers\CallbackComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class CallbackServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin*', CallbackComposer::class);
    }
}
