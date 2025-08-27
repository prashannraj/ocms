<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\OfficeSetting;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Middlewares\RoleMiddleware;

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
        //
        View::composer('*', function ($view) {
            $officeSettings = OfficeSetting::first();
            $view->with('officeSettings', $officeSettings);
        });

    }
}
