<?php

declare(strict_types=1);

namespace App\Discounts;

use App\Model\Product;

final class ItemPricingRule3for130 implements ItemPricingRuleInterface
{
    public function applies(string $productSku): bool
    {
        return $productSku === 'A';
    }

    /**
     * @param array<int, Product> $products
     */
    public function getDiscountedPriceInCents(array $products): int
    {
        $unitPrice = $products[0]->getPriceInCents(); // this sux, but ok for now
        $totalItems = count($products);
        $setsOfThree = intdiv($totalItems, 3);
        $remainingItems = $totalItems % 3;
        $priceForSets = $setsOfThree * 130;
        $priceForRemaining = $remainingItems * $unitPrice;

        return $priceForSets + $priceForRemaining;
    }
}
