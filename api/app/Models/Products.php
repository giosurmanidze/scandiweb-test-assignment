<?php

namespace App\Models;

use App\Utils\HttpResponse;
use App\Utils\ProductHelper;

class Products
{
    public function add(array $data): void
    {
        try {
            $type = strtolower($data['type'] ?? '');

            ProductHelper::validateProductData($data, $type);
            $data = ProductHelper::convertFloatFields($data, $type);

            $product = ProductHelper::createProductInstance($data);
            if ($product === null) {
                HttpResponse::validationError('Invalid product type');
                return;
            }
            $product->save();
        } catch (\InvalidArgumentException $e) {
            HttpResponse::validationError($e->getMessage());
        } catch (\Exception $e) {
            HttpResponse::dbError($e->getMessage());
        }
    }
}
