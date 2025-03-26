<?php

namespace Citadel\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CitadelServiceProvider extends ServiceProvider
{
    public function register()
    {
        require_once __DIR__ . '/../helpers.php';
        Route::macro('citadel', function ($uri, $action) {
            return Route::match(['get', 'post'], $uri, $action);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../dist' => public_path('citadelkit'),
        ], 'citadel');
        $this->loadViewsFrom(__DIR__ . "/../../resources/views/components", 'citadel-component');
        $this->loadViewsFrom(__DIR__ . "/../../resources/views/templates", 'citadel-template');
        $this->mergeConfigFrom(__DIR__ . "/../config/citadel.php", 'citadel-config');
    }
}
