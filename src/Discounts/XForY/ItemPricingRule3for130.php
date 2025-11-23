<?php

declare(strict_types=1);

namespace App\Discounts\XForY;

final class ItemPricingRule3for130 extends AbstractItemPricingRuleXforY
{
    public const string SKU = 'A';

    public const int GROUP_SIZE = 3;

    public const int PRICE_IN_CENT = 130;

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
        return self::PRICE_IN_CENT;
    }
}
