<?php

declare(strict_types=1);

namespace App\Discounts;

use App\Model\Product;

final class ItemPricingRule3for130 implements ItemPricingRuleInterface
{
    private const GROUP_SIZE = 3;

    private const SPECIAL_PRICE = 130;

    public function applies(string $productSku): bool
    {
        return $productSku === 'A';
    }

    /**
     * @param array<int, Product> $products
     */
    public function getDiscountedPriceInCents(array $products): int
    {
        $setCount = $this->countGroups($products);
        $priceForSets = $setCount * self::SPECIAL_PRICE;

        // remove the products covered by discounted sets
        $remaining = array_slice($products, $setCount * self::GROUP_SIZE);

        $priceForRemaining = 0;
        foreach ($remaining as $product) {
            $priceForRemaining += $product->getPriceInCents();
        }

        return $priceForSets + $priceForRemaining;
    }

    /**
     * @param array<int, Product> $products
     */
    private function countGroups(array $products): int
    {
        return intdiv(count($products), self::GROUP_SIZE);
    }
}
