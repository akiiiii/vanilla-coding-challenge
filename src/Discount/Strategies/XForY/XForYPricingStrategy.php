<?php

declare(strict_types=1);

namespace App\Discount\Strategies;

use App\Model\Product;

final class XForYPricingStrategy implements PricingStrategyInterface
{
    /** @var array<int, Product> */
    private array $products = [];

    public function __construct(
        private int $groupSize,
        private int $specialPrice,
    ) {
    }

    public function getId(): string
    {
        return sprintf('x_for_y_%d_%d', $this->groupSize, $this->specialPrice);
    }

    public function add(Product $product): void
    {
        $this->products[] = $product;
    }

    public function calculate(): int
    {
        $numberOfProducts = count($this->products);
        $groupCount = intdiv($numberOfProducts, $this->groupSize);
        $groupTotal = $groupCount * $this->specialPrice;

        $restProducts = array_slice($this->products, $groupCount * $this->groupSize);
        $restTotal = array_sum(
            array_map(
                fn (Product $p): int => $p->getPriceInCents(),
                $restProducts,
            ),
        );

        return $groupTotal + $restTotal;
    }
}
