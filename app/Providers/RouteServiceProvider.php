<?php

namespace Vendor\MyPlugin\Providers;

use Arc\Routing\Router;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $router->group([
            'namespace' => 'Vendor\MyPlugin\Http\Controllers',
        ], function () use ($router) {

            // Load browser routes
            include $this->app->basePath().'/routes/web.php';

            // Load API routes
            include $this->app->basePath().'/routes/api.php';
        });
    }
}
