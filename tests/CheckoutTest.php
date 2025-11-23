<?php

declare(strict_types=1);

namespace Tests;

use App\Checkout;
use App\Discounts\DiscountEligibilityChecker;
use App\Discounts\XForY\ItemPricingRule2for45;
use App\Discounts\XForY\ItemPricingRule3for130;
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

    public function testSpecialPricingForA()
    {
        $productA = new Product('A', 50);

        $checkout = new Checkout(
            new DiscountEligibilityChecker(
                [
                    new ItemPricingRule3for130(),
                ],
            ),
        );

        $checkout->scan($productA);
        $checkout->scan($productA);
        $checkout->scan($productA);

        $this->assertEquals(130, $checkout->getTotal());
    }

    public function testSpecialPricingForB()
    {
        $productB = new Product('B', 30);

        $checkout = new Checkout(
            new DiscountEligibilityChecker(
                [
                    new ItemPricingRule2for45(),
                ],
            ),
        );

        $checkout->scan($productB);
        $checkout->scan($productB);

        $this->assertEquals(45, $checkout->getTotal());
    }

    public function testMixedItemsWithRules()
    {
        $productA = new Product('A', 50);
        $productB = new Product('B', 30);
        $productD = new Product('D', 15);

        $checkout = new Checkout(
            new DiscountEligibilityChecker(
                [
                    new ItemPricingRule3for130(),
                    new ItemPricingRule2for45(),
                ],
            ),
        );

        $checkout->scan($productA);
        $checkout->scan($productA);
        $checkout->scan($productA);

        $checkout->scan($productB);
        $checkout->scan($productB);

        $checkout->scan($productD);

        $this->assertEquals(190, $checkout->getTotal());
    }

    public function testOrderIndependence()
    {
        $productA = new Product('A', 50);
        $productB = new Product('B', 30);
        $productD = new Product('D', 15);

        $checkout = new Checkout(
            new DiscountEligibilityChecker(
                [
                    new ItemPricingRule3for130(),
                    new ItemPricingRule2for45(),
                ],
            ),
        );

        $checkout->scan($productD);
        $checkout->scan($productA);
        $checkout->scan($productB);
        $checkout->scan($productA);
        $checkout->scan($productB);
        $checkout->scan($productA);

        $this->assertEquals(190, $checkout->getTotal());
    }

    public function testIncrementalTotals()
    {
        $productA = new Product('A', 50);
        $productB = new Product('B', 30);

        $checkout = new Checkout(
            new DiscountEligibilityChecker(
                [
                    new ItemPricingRule3for130(),
                    new ItemPricingRule2for45(),
                ],
            ),
        );

        $this->assertEquals(0, $checkout->getTotal());

        $checkout->scan($productA);
        $this->assertEquals(50, $checkout->getTotal());

        $checkout->scan($productB);
        $this->assertEquals(80, $checkout->getTotal());

        $checkout->scan($productA);
        $this->assertEquals(130, $checkout->getTotal());

        $checkout->scan($productA);
        $this->assertEquals(160, $checkout->getTotal());

        $checkout->scan($productB);
        $this->assertEquals(175, $checkout->getTotal());
    }
}
