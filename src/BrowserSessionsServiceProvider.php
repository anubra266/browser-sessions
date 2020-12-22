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

            $migrationFileName = 'create_browser_sessions_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                BrowserSessionsCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'browser-sessions');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/browser-sessions.php', 'browser-sessions');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
