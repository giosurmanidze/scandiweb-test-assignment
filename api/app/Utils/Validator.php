<?php

namespace App\Utils;

use InvalidArgumentException;


class Validator
{
    public static function validateRequiredFields(array $data, array $requiredFields): void
    {
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                throw new InvalidArgumentException("Field '$field' is required.");
            }
        }
    }

    public static function validatePositiveNumber(string $key, float $value): void
    {
        if (!is_numeric($value) || $value <= 0) {
            throw new InvalidArgumentException("$key must be a positive number.");
        }
    }

    public static function validateProductFields(array $data, string $type): void
    {
        $commonRequiredFields = ['type', 'sku', 'name', 'price'];
        self::validateRequiredFields($data, $commonRequiredFields);

        $additionalFields = Constants::PRODUCT_TYPE_PROPERTIES[$type] ?? [];
        self::validateRequiredFields($data, $additionalFields);
    }

    public static function validateArrayOfSkus(array $skus): void
    {
        if (empty($skus) || !is_array($skus)) {
            throw new InvalidArgumentException('SKUs should be a non-empty array.');
        }
    }
}
