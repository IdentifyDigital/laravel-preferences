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

        $this->app->bind('preference', function () { return new Setting(); });

        //Publishing to packages config
        $this->publishes([
            __DIR__.'/Config/preferences.php' => config_path('preferences.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/Config/preferences.php', 'preferences'
        );
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
