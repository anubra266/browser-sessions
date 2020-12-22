<?php

namespace Anubra266\BrowserSessions;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Anubra266\BrowserSessions\Commands\BrowserSessionsCommand;

class BrowserSessionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/browser-sessions.php' => config_path('browser-sessions.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/browser-sessions'),
            ], 'views');
            $this->commands([
                BrowserSessionsCommand::class,
            ]);
        }
        $this->registerRoutes();
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'browser-sessions');
    }
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('browser-sessions.prefix'),
            'middleware' => config('browser-sessions.middleware'),
            'namespace'=> 'Anubra266\\BrowserSessions\\Http\\Controllers'
        ];
    }
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/browser-sessions.php', 'browser-sessions');
        $this->app->bind('browser-sessions', function ($app) {
            return new BrowserSessions();
        });
    }
}
