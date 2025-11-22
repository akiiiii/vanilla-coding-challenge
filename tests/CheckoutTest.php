<?php

declare(strict_types=1);

namespace Tests;

use App\Checkout;
use App\Discounts\ItemPricingRule3for130;
use App\Model\Product;
use PHPUnit\Framework\TestCase;

final class CheckoutTest extends TestCase
{
    public function testEmptyCheckout()
    {
        $checkout = new Checkout();

        $this->assertEquals(0, $checkout->getTotal());
    }

    public function testCheckoutNoRules()
    {
        $productA = new Product('A', 50);

        $checkout = new Checkout();

        $checkout->scan($productA);

        $this->assertEquals(50, $checkout->getTotal());
    }

    public function testCheckoutMultipleItemsNoRules()
    {
        $productA = new Product('A', 50);
        $productB = new Product('B', 30);

        $checkout = new Checkout();

        $checkout->scan($productA);
        $checkout->scan($productB);
        $checkout->scan($productA);

        $this->assertEquals(130, $checkout->getTotal());
    }

    public function testCheckoutWithPricingRules()
    {
        $productA = new Product('A', 50);

        $productB = new Product('B', 30);

        $checkout = new Checkout(
            [
                new ItemPricingRule3for130(),
            ],
        );

        $checkout->scan($productA);
        $checkout->scan($productB);
        $checkout->scan($productA);
        $checkout->scan($productA);
        $checkout->scan($productA);

        $this->assertEquals(210, $checkout->getTotal());
    }
}
