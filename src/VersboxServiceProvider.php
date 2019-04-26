<?php

namespace JuniorE\Versbox;

use Illuminate\Support\ServiceProvider;
    use JuniorE\Versbox\Console\ClearCommand;
    use JuniorE\Versbox\Console\AllocateCommand;
use JuniorE\Versbox\Console\ReadyCommand;
use JuniorE\Versbox\Console\ReleaseCommand;

class VersboxServiceProvider extends ServiceProvider
    {
        /**
         * Bootstrap the application services.
         */
        public function boot()
        {
            /*
             * Optional methods to load your package assets
             */
            // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'versbox');
            // $this->loadViewsFrom(__DIR__.'/../resources/views', 'versbox');
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
            // $this->loadRoutesFrom(__DIR__.'/routes.php');

            if ($this->app->runningInConsole()) {
                $this->publishes([
                    __DIR__.'/../config/config.php' => config_path('versbox.php'),
                ], 'config');

                // Publishing the views.
                /*$this->publishes([
                    __DIR__.'/../resources/views' => resource_path('views/vendor/versbox'),
                ], 'views');*/

                // Publishing assets.
                /*$this->publishes([
                    __DIR__.'/../resources/assets' => public_path('vendor/versbox'),
                ], 'assets');*/

                // Publishing the translation files.
                /*$this->publishes([
                    __DIR__.'/../resources/lang' => resource_path('lang/vendor/versbox'),
                ], 'lang');*/

                // Registering package commands.
                $this->commands([
                    ClearCommand::class,
                    AllocateCommand::class,
                    ReadyCommand::class,
                    ReleaseCommand::class
                ]);
            }
        }

        /**
         * Register the application services.
         */
        public function register()
        {
            // Automatically apply the package configuration
            $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'versbox');

            // Register the main class to use with the facade
            $this->app->singleton('versbox', function ($app) {
                return new Versbox($app['config']);
            });
        }
    }
