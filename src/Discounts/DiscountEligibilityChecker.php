<?php

declare(strict_types=1);

namespace App\Discounts;

final class DiscountEligibilityChecker
{
    /**
     * @param array<int, ItemPricingRuleInterface> $itemPricingRules
     */
    public function __construct(
        private array $itemPricingRules,
    ) {
    }

    /**
     * @return array<int, ItemPricingRuleInterface>
     */
    public function getPricingRules(): array
    {
        return $this->itemPricingRules;
    }
}
