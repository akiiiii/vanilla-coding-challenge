<?php

declare(strict_types=1);

namespace App\Discount\Rules\XForY;

use App\Discount\Rules\ItemPricingRuleInterface;
use App\Discount\Strategies\PricingStrategyInterface;
use App\Discount\Strategies\XForYPricingStrategy;
use App\Model\Product;

abstract class AbstractItemPricingRule implements ItemPricingRuleInterface
{
    abstract protected function groupSize(): int;

    abstract protected function specialPrice(): int;

    abstract protected function sku(): string;

    public function applies(Product $product): bool
    {
        return $product->getSku() === $this->sku();
    }

    public function createStrategy(): PricingStrategyInterface
    {
        return new XForYPricingStrategy(
            $this->groupSize(),
            $this->specialPrice(),
        );
    }
}
