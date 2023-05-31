<?php

namespace App\Providers;

use App\View\Composers\PageComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
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
        View::composer(['frontend*', 'user*'], PageComposer::class);
    }
}
