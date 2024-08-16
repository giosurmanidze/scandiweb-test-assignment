<?php

namespace App\Utils;

class Constants
{
    const PRODUCT_TYPE_PROPERTIES =
    [
        ProductType::DVD->value => ['size'],
        ProductType::BOOK->value => ['weight'],
        ProductType::FURNITURE->value => ['height', 'width', 'length'],
    ];
}
