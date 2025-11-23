<?php

declare(strict_types=1);

namespace App;

use App\Discount\Rules\ItemPricingRuleInterface;

use App\Discount\Strategies\PricingStrategyInterface;
use App\Discount\Strategies\StandardPricingStrategy;
use App\Model\Product;

final class Scanner
{
    /**
     * @var array<int, array{rule: ItemPricingRuleInterface, strategy: PricingStrategyInterface}>
     */
    private array $ruleStrategies = [];

    private StandardPricingStrategy $standardStrategy;

    /**
     * @param array<int, ItemPricingRuleInterface> $rules
     */
    public function __construct(array $rules = [])
    {
        foreach ($rules as $rule) {
            $strategy = $rule->createStrategy();

            $this->ruleStrategies[] = [
                'rule' => $rule,
                'strategy' => $strategy,
            ];
        }

        $this->standardStrategy = new StandardPricingStrategy();
    }

    public function scan(Product $product): void
    {
        foreach ($this->ruleStrategies as $pair) {
            if ($pair['rule']->applies($product)) {
                $pair['strategy']->add($product);

                return;
            }
        }

        // no rule matched → standard strategy
        $this->standardStrategy->add($product);
    }

    /**
     * @return array<int, PricingStrategyInterface>
     */
    public function getStrategies(): array
    {
        $strategies = [];

        foreach ($this->ruleStrategies as $pair) {
            $strategies[] = $pair['strategy'];
        }

        $strategies[] = $this->standardStrategy;

        return $strategies;
    }
}
