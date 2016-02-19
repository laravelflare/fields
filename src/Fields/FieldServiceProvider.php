<?php

namespace LaravelFlare\Fields;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->publishConfig();
        $this->publishViews();
    }

    /**
     * Register any package services.
     */
    public function register()
    {
        
    }

    /**
     * Publishes the Flare Assets to the appropriate directories.
     */
    protected function publishAssets()
    {
        $assets = [];

        foreach ($this->assets as $location => $asset) {
            $assets[$this->basePath($location)] = base_path($asset);
        }

        $this->publishes($assets, 'public');
    }

    /**
     * Publishes the Flare Fields Config File.
     */
    protected function publishConfig()
    {
        $this->publishes([
            $this->basePath('config/flare/fields.php') => config_path('flare/fields.php'),
        ]);
    }

    /**
     * Publishes the Flare Field Views and defines the location
     * they should be looked for in the application.
     */
    protected function publishViews()
    {
        $this->loadViewsFrom($this->basePath('resources/views'), 'flare');
        $this->publishes([
            $this->basePath('resources/views') => base_path('resources/views/vendor/flare'),
        ]);
    }

    /**
     * Returns the path to a provided file within the Flare package.
     * 
     * @param bool $fiepath
     * 
     * @return string
     */
    private function basePath($filepath = false)
    {
        return __DIR__.'/../'.$filepath;
    }
}
