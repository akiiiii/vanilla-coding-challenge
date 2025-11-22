<?php

declare(strict_types=1);

namespace App\Discounts;

use App\Model\Product;

final class ItemPricingRule2for45 implements ItemPricingRuleInterface
{
    private const GROUP_SIZE = 2;

    private const SPECIAL_PRICE = 45;

    public function applies(string $productSku): bool
    {
        return $productSku === 'B';
    }

    /**
     * @param array<int, Product> $products
     */
    public function getDiscountedPriceInCents(array $products): int
    {
        $groupCount = $this->countGroups($products);
        $priceForGroups = $groupCount * self::SPECIAL_PRICE;

        // remove the products included in discounted groups
        $remaining = array_slice($products, $groupCount * self::GROUP_SIZE);

        $priceForRemaining = 0;
        foreach ($remaining as $product) {
            $priceForRemaining += $product->getPriceInCents();
        }

        return $priceForGroups + $priceForRemaining;
    }

    /**
     * @param array<int, Product> $products
     */
    private function countGroups(array $products): int
    {
        return intdiv(count($products), self::GROUP_SIZE);
    }
}
