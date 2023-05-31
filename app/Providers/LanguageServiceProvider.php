<?php

namespace App\Providers;

use App\View\Composers\LanguageComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
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
        View::composer(['frontend*', 'user*'], LanguageComposer::class);
    }
}
