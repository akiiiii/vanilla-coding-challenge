<?php

declare(strict_types=1);

namespace App\Model;

final class Product
{
    public function __construct(
        private string $sku,
        private int $priceInCents,
    ) {
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getPriceInCents(): int
    {
        return $this->priceInCents;
    }
}
