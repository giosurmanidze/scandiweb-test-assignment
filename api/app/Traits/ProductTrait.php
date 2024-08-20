<?php

namespace App\Traits;

use App\Database\Db;
use App\Utils\HttpResponse;
use App\Utils\ProductHelper;

trait ProductTrait
{
    public function save(): void
    {
        $data = $this->getData();
        $dbTable = $data['type'];
        $keysToExclude = ['name', 'price', 'type'];
        $productKeys = ['sku', 'name', 'price', 'type'];

        $specificTableData = [];
        $productsTableData = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $productKeys)) {
                $productsTableData[$key] = $value;
            }
            if (!in_array($key, $keysToExclude)) {
                $specificTableData[$key] = $value;
            }
        }

        try {
            $dbConn = Db::getConnection();
            $dbConn->beginTransaction();

            ProductHelper::insertProduct($dbConn, $productsTableData);
            ProductHelper::insertIntoDynamicTable($dbConn, $dbTable, $specificTableData);

            $dbConn->commit();
            HttpResponse::added();
        } catch (\Exception $e) {
            // Rollback transaction on error
            $dbConn->rollBack();
            HttpResponse::dbError($e->getMessage());
        }
    }

    public static function getAll(string $dbTable): ?array
    {
        try {
            $dbConn = Db::getConnection();

            $sql = "SELECT p.sku, p.name, p.price, p.type, s.* 
            FROM products AS p 
            INNER JOIN $dbTable AS s ON p.sku = s.sku 
            ORDER BY p.id";

            $stmt = $dbConn->prepare($sql);
            $stmt->execute();
            $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $products;
        } catch (\Exception $e) {
            HttpResponse::dbError($e->getMessage());
            return null;
        }
    }
}
