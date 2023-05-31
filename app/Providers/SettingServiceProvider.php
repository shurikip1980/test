<?php

namespace App\Providers;

use App\View\Composers\SettingComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
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
        View::composer(['frontend*', 'user*'], SettingComposer::class);
    }
}
