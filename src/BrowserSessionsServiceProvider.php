<?php

namespace Anubra266\BrowserSessions;

use Anubra266\BrowserSessions\Commands\BrowserSessionsCommand;
use Illuminate\Support\ServiceProvider;

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

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'browser-sessions');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/browser-sessions.php', 'browser-sessions');
        $this->app->bind('browser-sessions', function ($app) {
            return new BrowserSessions();
        });
    }
}
