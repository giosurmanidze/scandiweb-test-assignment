<?php

namespace App;


error_reporting(E_ALL);
ini_set('display_errors', 1); // Should be set to 0 in production

use App\Controllers\ProductController;
use App\Models\Products;
use Bramus\Router\Router;

class App
{
    private static function setRoutes(): void
    {
        $router = new Router();

        $productModel = new Products();
        $productController = new ProductController($productModel);

        $router->post('/create-product', [$productController, 'createProduct']);

        $router->run();
    }

    public static function run()
    {
        self::setRoutes();
    }
}
