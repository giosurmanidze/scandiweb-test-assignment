<?php

namespace App\Models;

class Book extends AbstractProduct
{
    public function __construct(
        string $sku,
        string $name,
        float $price,
        string $type,
        protected float $weight
    ) {
        parent::__construct($sku, $name, $price, $type);
    }
}
