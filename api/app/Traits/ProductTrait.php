<?php

namespace App\Traits;

use App\Database\Db;
use App\Utils\HttpResponse;

trait ProductTrait
{
    public function save(): void
    {
        $data = $this->getData();
        $dbTable = $data['type'];
        $keysToExclude = ['name', 'price', 'type'];
        $productKeys = ['sku', 'name', 'price', 'type'];

        $specificTableData = array_diff_key($data, array_flip($keysToExclude));
        $productData = array_intersect_key($data, array_flip($productKeys));

        try {
            $dbConn = Db::getConnection();

            $query = "INSERT INTO products (sku, name,price,type)  VALUES (:sku, :name, :price, :type)";
            $stmt = $dbConn->prepare($query);
            $stmt->execute($productData);

            $columns = implode(", ", array_keys($specificTableData));
            $placeholders = implode(", ", array_map(fn($key) => ":$key", array_keys($specificTableData)));
            $sql = "INSERT INTO $dbTable ($columns) VALUES ($placeholders)";
            $stmt = $dbConn->prepare($sql);
            $stmt->execute($specificTableData);

            HttpResponse::added();
        } catch (\Exception $e) {
            HttpResponse::dbError($e->getMessage());
        }
    }

    public static function getAll(string $dbTable): ?array
    {
        return [];
    }
}
