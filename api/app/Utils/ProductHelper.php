<?php

namespace App\Utils;

class ProductHelper
{
    public static function convertFloatFields(array $data, string $type): array
    {
        $floats = array_merge(['price'], Constants::PRODUCT_TYPE_PROPERTIES[$type] ?? []);
        foreach ($floats as $field) {
            if (isset($data[$field])) {
                $data[$field] = (float) $data[$field];
            }
        }
        return $data;
    }

    public static function validateProductData(array $data, string $type):void
    {
        Validator::validateProductFields($data, $type);
        Validator::validatePositiveNumber('price', $data['price']);
    }

    public static function createProductInstance(array $data): ?object
    {
        $className = "App\\Models\\" . ucfirst($data['type']);
        if (class_exists($className)) {
            return new $className(...array_values($data));
        }
        return null;
    }
}