<?php

namespace MnKashpour\LaravelCrudGenerator;

use Illuminate\Support\ServiceProvider;
use MnKashpour\LaravelCrudGenerator\Commands\GenerateCrudCommand;

class LaravelCrudGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mnkashpour');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mnkashpour');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-crud-generator.php', 'laravel-crud-generator');

        // Register the service the package provides.
        // $this->app->singleton('laravel-crud-generator', function ($app) {
        //     return new LaravelCrudGenerator;
        // });
    }

    // /**
    //  * Get the services provided by the provider.
    //  *
    //  * @return array
    //  */
    // public function provides()
    // {
    //     return ['laravel-crud-generator'];
    // }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-crud-generator.php' => config_path('laravel-crud-generator.php'),
        ], 'laravel-crud-generator.config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/mnkashpour'),
        ], 'laravel-crud-generator.views');

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/mnkashpour'),
        ], 'laravel-crud-generator.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/mnkashpour'),
        ], 'laravel-crud-generator.lang');*/

        // Registering package commands.
        $this->commands([
            GenerateCrudCommand::class,
        ]);
    }
}
