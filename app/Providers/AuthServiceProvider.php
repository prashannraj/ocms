<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\OfficeSetting;
use App\Policies\OfficeSettingPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        OfficeSetting::class => OfficeSettingPolicy::class,
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
