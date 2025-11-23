<?php

declare(strict_types=1);

namespace App;

use App\Discount\Rules\ItemPricingRuleInterface;
use App\Model\Product;

final class Checkout
{
    private Scanner $scanner;

    /**
     * @param array<int, ItemPricingRuleInterface> $rules
     */
    public function __construct(
        array $rules = [],
    ) {
        $this->scanner = new Scanner($rules);
    }

    public function scan(Product $product): void
    {
        $this->scanner->scan($product);
    }

    public function getTotal(): int
    {
        $total = 0;
        foreach ($this->scanner->getStrategies() as $strategy) {
            $total += $strategy->calculate();
        }

        return $total;
    }
}
