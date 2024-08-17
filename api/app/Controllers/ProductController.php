<?php

namespace App\Controllers;

use App\Models\Products;

class ProductController
{
    private Products $products;

    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    public function getProducts(): void
    {
        $this->products->get();
    }

    public function createProduct(): void
    {
        $product = $_POST;
        $this->products->add($product);
    }
}
