<?php

namespace App\Models;

use App\Traits\ProductTrait;

class Dvd extends AbstractProduct
{
    use ProductTrait;

    public function __construct(
        string $sku,
        string $name,
        float $price,
        string $type,
        protected string $size
    ) {
        parent::__construct($sku, $name, $price, $type);
    }

    public function getData(): array
    {
        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            'type' => $this->type,
            'size' => $this->size,
        ];
    }
}
