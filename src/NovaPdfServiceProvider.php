<?php

namespace Padocia\NovaPdf;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class NovaPdfServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('/views/nova-pdf'),
            ], 'nova-pdf-template');
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-nova-pdf');

        $this->app->booted(function () {
            $this->routes();
        });
    }

    /**
     * Register routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
                ->prefix('nova-vendor/padocia/laravel-nova-pdf')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            Console\ActionCommand::class,
        ]);
    }
}
