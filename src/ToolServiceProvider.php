<?php

namespace Eolica\NovaLocaleSwitcher;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Eolica\NovaLocaleSwitcher\Http\Middleware\Authorize;

final class ToolServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });
    }

    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/locale-switcher')
                ->group(__DIR__.'/../routes/api.php');
    }
}
