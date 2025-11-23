<?php

declare(strict_types=1);

namespace App\Discount\Rules;

use App\Discount\Strategies\PricingStrategyInterface;
use App\Discount\Strategies\StandardPricingStrategy;
use App\Model\Product;

final class StandardItemPricingRule implements ItemPricingRuleInterface
{
    public function applies(Product $product): bool
    {
        return true;
    }

    public function createStrategy(): PricingStrategyInterface
    {
        return new StandardPricingStrategy();
    }
}
