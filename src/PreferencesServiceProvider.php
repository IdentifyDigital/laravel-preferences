<?php

namespace IdentifyDigital\Preferences;

use IdentifyDigital\Preferences\Models\Setting;
use Illuminate\Support\ServiceProvider;

class PreferencesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Loading the package migrations
        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $this->app->bind('preferences', function () { return new Setting(); });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
