<?php

declare(strict_types=1);

namespace App\Discount\Strategies;

use App\Model\Product;

interface PricingStrategyInterface
{
    public function add(Product $product): void;

    public function calculate(): int;

    public function getId(): string;
}
