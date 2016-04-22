<?php

namespace Mpclarkson\Laravel\Freshdesk;

use Freshdesk\Api as Freshdesk;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;

class FreshdeskServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $source = dirname(__DIR__).'/src/config/freshdesk.php';

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('freshdesk.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('freshdesk');
        }
        $this->mergeConfigFrom($source, 'freshdesk');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('freshdesk', function ($app) {
            $config = $app->make('config')->get('freshdesk');
            return new Api($config['api_key'], $config['domain']);
        });
        $this->app->alias('freshdesk', '\Mpclarkson\Laravel\Freshdesk\Api');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['freshdesk', '\Mpclarkson\Laravel\Freshdesk\Api'];
    }
}
