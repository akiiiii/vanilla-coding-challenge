<?php

declare(strict_types=1);

namespace App;

use App\Model\Product;

final class Checkout
{
    /** @var array<int,Product> */
    private array $items = [];

    public function scan(Product $product): void
    {
        $this->items[] = $product;
    }

    public function getTotal(): int
    {
        $total = 0;
        foreach ($this->items as $product) {
            // no pricing rules yet
            $total += $product->getPriceInCents();
        }

        return $total;
    }
}
