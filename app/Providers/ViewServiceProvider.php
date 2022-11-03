<?php

namespace App\Providers;

use App\Http\Views\Composer\BXHHANComposer;
use App\Http\Views\Composer\BXHHOAComposer;
use App\Http\Views\Composer\BXHUSComposer;
use App\Http\Views\Composer\BXHVNComposer;
use App\Http\Views\Composer\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('header',MenuComposer::class);
        View::composer('bxh.bxhvn',BXHVNComposer::class);
        View::composer('bxh.bxhus',BXHUSComposer::class);
        View::composer('bxh.bxhhoa',BXHHOAComposer::class);
        View::composer('bxh.bxhhan',BXHHANComposer::class);
    }
}
