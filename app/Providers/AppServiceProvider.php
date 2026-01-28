<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\GeneralSetting;
use App\Models\Page;

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
        View::composer('*', function ($view) {
            $settings = GeneralSetting::first();
            $view->with('settings', $settings);
        });

        View::share('globalPages', Page::where('is_active', true)->get());
    }
}
