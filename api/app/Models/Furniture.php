<?php

namespace App\Models;

use App\Traits\ProductTrait;

class Furniture extends AbstractProduct
{
    use ProductTrait;

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

    public function getData(): array
    {
        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            'type' => $this->type,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
        ];
    }
}
