<?php

namespace Citadel\Providers;

use Citadel\AuthRouteMethods;
use Citadel\Commands\BuildCommand;
use Citadel\Commands\CitadelCommand;
use Citadel\Components;
use Citadel\Components\Control\Button;
use Citadel\View\Components\HeaderNavContainer;
use Citadel\View\Components\HeaderNavMenuItem;
use Citadel\View\Components\HeaderNavNotification;
use Citadel\View\Components\HeaderNavSearch;
use Citadel\View\Components\HeaderNavToggle;
use Citadel\View\Components\HeaderNavUser;
use Citadel\View\Components\NavContainer;
use Citadel\View\Components\NavHeading;
use Citadel\View\Components\NavMenuItem;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CitadelServiceProvider extends ServiceProvider
{
    public function register()
    {
        require_once __DIR__ . '/../helpers.php';
        Route::macro('citadel', function ($uri, $action) {
            return Route::match(['get', 'post'], $uri, $action);
        });

        $this->commands([CitadelCommand::class, BuildCommand::class]);
    }

    public function boot()
    {
        if (!App::runningInConsole()) {
            Blade::directive('vitadel', function ($expression) {
                $expression = explode(',', str_replace(["'", ' '], '', $expression));
                $result = (new Vite())->useBuildDirectory('citadelkit')->withEntryPoints($expression)->toHtml();
                return $result;
            });
        } else {
            $this->publishes(
                [
                    __DIR__ . '/../../dist' => public_path('citadelkit'),
                ],
                'citadel',
            );

            $this->publishes(
                [
                    __DIR__ . '/../config/citadel.php' => config_path('citadel.php'),
                ],
                'citadel',
            );
        }
        
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/components', 'citadel-component');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/templates', 'citadel-template');
        // $this->mergeConfigFrom(config_path('citadel.php'), 'citadel');
        $this->registerComponent();
    }

    public function registerComponent()
    {
        Blade::componentNamespace('Citadel\\Components', 'citadel');
        // Blade::componentNamespace('Citadel\\Components\\Control', 'citadel');
        // dd(Blade::getClassComponentNamespaces());
        Blade::component('nav-container', NavContainer::class);
        Blade::component('nav-menu-item', NavMenuItem::class);
        Blade::component('nav-heading', NavHeading::class);
        Blade::component('header-nav-container', HeaderNavContainer::class);
        Blade::component('header-nav-toggle', HeaderNavToggle::class);
        Blade::component('header-nav-search', HeaderNavSearch::class);
        Blade::component('header-nav-user', HeaderNavUser::class);
        Blade::component('header-nav-notification', HeaderNavNotification::class);
        Blade::component('header-nav-menu-item', HeaderNavMenuItem::class);

        Blade::directive('citadel', function ($callback) {
            class_alias(Button::class, 'Button');
            $x = eval('return ' . $callback . ';');
            $view = $x->resolveView();
            $data = $x->data();
            if ($view instanceof \Closure) {
                $view = $view($data);
            }
            return View::make($view, $data + ['component' => $x])->render();
        });
    }
}
