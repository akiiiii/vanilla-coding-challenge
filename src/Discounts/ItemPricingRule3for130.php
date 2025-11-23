<?php

declare(strict_types=1);

namespace App\Discounts;

final class ItemPricingRule3for130 extends AbstractItemPricingRuleXforY
{
    protected function groupSize(): int
    {
        return 3;
    }

    protected function specialPrice(): int
    {
        return 130;
    }

    protected function sku(): string
    {
        return 'A';
    }
}
