<?php

declare(strict_types=1);

namespace App\Model;

final readonly class Product
{
    public function __construct(
        private string $sku,
        private int $priceInCents,
    ) {
    }

    public function getPriceInCents(): int
    {
        return $this->priceInCents;
    }
}
