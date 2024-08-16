<?php

namespace App\Models;

abstract class AbstractProduct
{
    protected function __construct(
        protected string $sku,
        protected string $name,
        protected float $price,
        protected string $type,
    ) {}

    abstract protected function save(): void;
    abstract protected function getData(): array;
    abstract protected static function getAll(string $dbTable): ?array;
}
