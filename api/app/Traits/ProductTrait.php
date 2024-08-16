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

        // removes unwanted keys
        $specificTableData = array_diff_key($data, array_flip($keysToExclude));
        //  Extracts the required keys
        $productData = array_intersect_key($data, array_flip($productKeys));

        try {
            $dbConn = Db::getConnection();

            ProductHelper::insertProduct($dbConn, $productData);
            ProductHelper::insertIntoDynamicTable($dbConn, $dbTable, $specificTableData);

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
