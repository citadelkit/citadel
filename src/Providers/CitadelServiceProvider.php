<?php

namespace Citadel\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CitadelServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::macro('citadel', function ($uri, $action) {
            return Route::match(['get', 'post'], $uri, $action);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/js/' => public_path('citadelkit/citadel'),
        ], 'public');
        $this->loadViewsFrom(__DIR__."/../resources/views/components", 'citadel-component');
        $this->loadViewsFrom(__DIR__."/../resources/views/templates", 'citadel-template');
    }
}