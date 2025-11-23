<?php

declare(strict_types=1);

namespace App\Discount\Rules\XForY;

final class ItemPricingRule3for130 extends AbstractItemPricingRule
{
    private const string SKU = 'A';

    private const int GROUP_SIZE = 3;

    private const int SPECIAL_PRICE_IN_CENTS = 130;

    public function sku(): string
    {
        return self::SKU;
    }

    protected function groupSize(): int
    {
        return self::GROUP_SIZE;
    }

    protected function specialPrice(): int
    {
        return self::SPECIAL_PRICE_IN_CENTS;
    }
}
