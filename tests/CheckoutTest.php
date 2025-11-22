<?php

declare(strict_types=1);

namespace Tests;

use App\Checkout;
use App\Model\Product;
use PHPUnit\Framework\TestCase;

final class CheckoutTest extends TestCase
{
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
}
