<?php

namespace App\Providers;

use App\Models\FrontOfficeSetting;
use App\Models\News;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['admin.*', 'auth.login', 'layouts.guest'], function ($view) {
            $view->with('adminSettings', FrontOfficeSetting::first());
        });

        View::composer('front.*', function ($view) {
            $view->with('headerNews', News::where('status', 'actif')->latest('id')->take(8)->get());
        });
    }
}
