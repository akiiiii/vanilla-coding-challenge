<?php

declare(strict_types=1);

namespace App\Discounts;

final class ItemPricingRule2for45 extends AbstractItemPricingRuleXforY
{
    protected function groupSize(): int
    {
        return 2;
    }

    protected function specialPrice(): int
    {
        return 45;
    }

    protected function sku(): string
    {
        return 'B';
    }
}
