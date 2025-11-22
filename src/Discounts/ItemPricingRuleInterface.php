<?php

declare(strict_types=1);

namespace App\Discounts;

use App\Model\Product;

interface ItemPricingRuleInterface
{
    public function applies(string $productSku): bool;

    /**
     * @param array<int, Product> $products
     */
    public function getDiscountedPriceInCents(array $products): int;
}
