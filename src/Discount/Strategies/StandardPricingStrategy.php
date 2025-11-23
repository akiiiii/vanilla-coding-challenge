<?php

declare(strict_types=1);

namespace App\Discount\Strategies;

use App\Model\Product;

final class StandardPricingStrategy implements PricingStrategyInterface
{
    /** @var array<int, Product> */
    private array $products = [];

    public function getId(): string
    {
        return 'standard';
    }

    public function add(Product $product): void
    {
        $this->products[] = $product;
    }

    public function calculate(): int
    {
        return array_sum(
            array_map(
                fn (Product $p): int => $p->getPriceInCents(),
                $this->products,
            ),
        );
    }
}
