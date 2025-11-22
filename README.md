# vanilla-coding-challenge
Small coding challenge project

## Challenge Summary

This project implements a supermarket checkout system that supports unit pricing and special multi-pricing rules (for example, “3 for 130”). Items are identified by SKUs (A–D) and can be scanned in any order. The checkout returns the running total based on the provided pricing rules.

### Pricing

| SKU | Unit Price | Special Price |
|-----|------------|----------------|
| A   | 50         | 3 for 130      |
| B   | 30         | 2 for 45       |
| C   | 20         | —              |
| D   | 15         | —              |

### Requirements

- Items can be scanned in any order.
- The total should update incrementally as items are scanned.
- Special pricing must be applied automatically when its conditions are met.
- A configurable list of pricing rules is provided when creating the checkout.
- Pricing logic should be decoupled so new rules can be added easily.

### Example

Scanning `AAABBD` should total **190**  
(130 for AAA, 45 for BB, 15 for D).

## Installation

This project uses PHP and Composer.  
Make sure you have PHP (8.4+) and Composer installed.

### 1. Install dependencies

```bash
composer install
```
### 2. Run tests

```bash
vendor/bin/phpunit tests
```
