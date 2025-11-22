<?php

declare(strict_types=1);

namespace App\Discounts;

use App\Model\Product;

final class ItemPricingRule2for45 implements ItemPricingRuleInterface
{
    public function applies(string $productSku): bool
    {
        return $productSku === 'B';
    }

    /**
     * @param array<int, Product> $products
     */
    public function getDiscountedPriceInCents(array $products): int
    {
        $unitPrice = $products[0]->getPriceInCents(); // this sux, but ok for now
        $totalItems = count($products);
        $setsOfThree = intdiv($totalItems, 2);
        $remainingItems = $totalItems % 2;
        $priceForSets = $setsOfThree * 45;
        $priceForRemaining = $remainingItems * $unitPrice;

        return $priceForSets + $priceForRemaining;
    }
}
