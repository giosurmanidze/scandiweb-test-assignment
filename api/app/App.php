<?php

namespace App;

error_reporting(E_ALL);
ini_set('display_errors', 1); // Should be set to 0 in production

use App\Controllers\ProductController;
use App\Models\Products;
use App\Utils\Headers;
use Bramus\Router\Router;
use Dotenv\Dotenv;

class App
{
    private static function setRoutes(): void
    {
        $router = new Router();

        $productModel = new Products();
        $productController = new ProductController($productModel);

        $router->get('/products', [$productController, 'getProducts']);
        $router->post('/create-product', [$productController, 'createProduct']);
        $router->post('/mass-delete', [$productController, 'deleteProducts']);

        $router->run();
    }

    private static function loadEnvVariables()
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->safeLoad();
    }

    public static function run()
    {
        Headers::set();
        self::loadEnvVariables();
        self::setRoutes();
    }
}
