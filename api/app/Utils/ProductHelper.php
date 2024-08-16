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

    public static function validateProductData(array $data, string $type): void
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

    public static function insertProduct($dbConn, array $productData): void
    {
        $query = "INSERT INTO products (sku, name, price, type) VALUES (:sku, :name, :price, :type)";
        $stmt = $dbConn->prepare($query);
        $stmt->execute($productData);
    }

    public static function insertIntoDynamicTable($dbConn, string $dbTable, array $filteredData): void
    {
        $columns = implode(", ", array_keys($filteredData));
        $placeholders = implode(", ", array_map(fn($key) => ":$key", array_keys($filteredData)));
        $sql = "INSERT INTO $dbTable ($columns) VALUES ($placeholders)";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($filteredData);
    }
}
