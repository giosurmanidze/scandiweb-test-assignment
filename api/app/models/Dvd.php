<?php

namespace App\Models;

class Dvd extends AbstractProduct
{
    public function __construct(
        string $sku,
        string $name,
        float $price,
        string $type,
        protected string $size
    ) {
        parent::__construct($sku, $name, $price, $type);
    }
}
