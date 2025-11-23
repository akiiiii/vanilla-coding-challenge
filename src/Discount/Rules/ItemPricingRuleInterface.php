<?php

declare(strict_types=1);

namespace App\Discount\Rules;

use App\Discount\Strategies\PricingStrategyInterface;
use App\Model\Product;

interface ItemPricingRuleInterface
{
    public function applies(Product $product): bool;

    public function createStrategy(): PricingStrategyInterface;
}
