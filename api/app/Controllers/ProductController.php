<?php

namespace App\Controllers;

use App\Models\Products;

class ProductController
{
    private Products $products;

    public function __construct()
    {
        $this->products = new Products();
    }

    public function createProduct(): void
    {
        $product = $_POST;
        $this->products->add($product);
    }

}