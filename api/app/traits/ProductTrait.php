<?php

namespace App\Traits;

trait ProductTrait
{
    public function save(): void {}
    public static function getAll(string $dbTable): ?array
    {
        return [];
    }
}
