<?php

namespace App\Models;

class Products
{
    public function add(array $data): void
    {
        try {

            $className = "App\\Models\\" . ucfirst($data['type']);
            $product = new $className(...array_values($data));

            if($product === null) {
                echo "Invalid product type";
            }

           $product->save();


        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
