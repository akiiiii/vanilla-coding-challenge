<?php

declare(strict_types=1);

namespace App\Discounts\XForY;

final class ItemPricingRule2for45 extends AbstractItemPricingRuleXforY
{
    public const string SKU = 'B';

    public const int GROUP_SIZE = 2;

    public const int PRICE_IN_CENTS = 45;

    protected function sku(): string
    {
        return self::SKU;
    }

    protected function groupSize(): int
    {
        return self::GROUP_SIZE;
    }

    protected function specialPrice(): int
    {
        return self::PRICE_IN_CENTS;
    }
}
