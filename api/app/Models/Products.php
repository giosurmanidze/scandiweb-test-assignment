<?php

namespace App\Models;

use App\Utils\HttpResponse;
use App\Utils\ProductHelper;
use App\Utils\ProductType;

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

    public function get(): void
    {
        try {
            $dvds = Dvd::getAll(ProductType::DVD->value);
            $books = Book::getAll(ProductType::BOOK->value);
            $furnitures = Furniture::getAll(ProductType::FURNITURE->value);

            $allProducts = array_merge($dvds, $books, $furnitures);

            http_response_code(200);
            echo json_encode($allProducts);
        } catch (\Exception $e) {
            HttpResponse::dbError($e->getMessage());
        }
    }
}
