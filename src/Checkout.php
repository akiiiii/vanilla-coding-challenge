<?php

declare(strict_types=1);

namespace App;

use App\Discounts\ItemPricingRuleInterface;
use App\Model\Product;

final class Checkout
{
    /** @var array<string, array<int, Product>> */
    private array $items = [];

    /** @param array<int, ItemPricingRuleInterface> $pricingRules */
    public function __construct(private array $pricingRules = [])
    {
    }

    public function scan(Product $product): void
    {
        $this->items[$product->getSku()][] = $product;
    }

    public function getTotal(): int
    {
        $total = 0;

        foreach ($this->items as $sku => $products) {
            $rule = $this->getPricingRuleForSku($sku);

            if ($rule !== null) {

                $total += $rule->getDiscountedPriceInCents($products);

                continue;
            }

            $total += $this->getStandardPriceInCents($products);
        }

        return $total;
    }

    private function getPricingRuleForSku(string $sku): ?ItemPricingRuleInterface
    {
        return array_find($this->pricingRules, fn ($rule) => $rule->applies($sku));
    }

    /**
     * @param array<int, Product> $products
     */
    public function getStandardPriceInCents(array $products): int
    {
        $productSubTotal = 0;
        foreach ($products as $product) {
            $productSubTotal += $product->getPriceInCents();
        }
        return $productSubTotal;
    }
}
