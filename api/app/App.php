<?php

namespace App;

error_reporting(E_ALL);
ini_set('display_errors', 1); // Should be set to 0 in production


use Bramus\Router\Router;

class App
{
    private static function setRoutes(): void
    {
        $router = new Router();
        $router->setNamespace('App\Controllers');

        $router->post('/create-product', 'ProductController@createProduct');

        $router->run();
    }

    public static function run()
    {
        self::setRoutes();
    }
}
