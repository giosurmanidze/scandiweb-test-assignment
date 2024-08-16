<?php

namespace App\Models;

class Furniture extends AbstractProduct
{
    public function __construct(
        string $sku,
        string $name,
        float $price,
        string $type,
        protected float $height,
        protected float $width,
        protected float $length,
    ) {
        parent::__construct($sku, $name, $price, $type);
    }
}
