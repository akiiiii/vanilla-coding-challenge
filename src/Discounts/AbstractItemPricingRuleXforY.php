<?php

declare(strict_types=1);

namespace App\Discounts;

use App\Model\Product;

abstract class AbstractItemPricingRuleXforY implements ItemPricingRuleInterface
{
    abstract protected function groupSize(): int;

    abstract protected function specialPrice(): int;

    abstract protected function sku(): string;

    public function applies(string $productSku): bool
    {
        return $productSku === $this->sku();
    }

    /**
     * @param array<int, Product> $products
     */
    public function getDiscountedPriceInCents(array $products): int
    {
        $groupCount = $this->countGroups($products);
        $priceForGroups = $groupCount * $this->specialPrice();

        // remove the products included in discounted groups
        $remaining = array_slice($products, $groupCount * $this->groupSize());

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
        return intdiv(count($products), $this->groupSize());
    }
}
