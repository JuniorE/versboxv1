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
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

            if ($this->app->runningInConsole()) {
                $this->publishes([
                    __DIR__ . '/../config/config.php' => config_path('versbox.php'),
                ], 'config');

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
            $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'versbox');

            // Register the main class to use with the facade
            $this->app->singleton('versbox', function ($app) {
                return new Versbox($app['config']);
            });
        }
    }
