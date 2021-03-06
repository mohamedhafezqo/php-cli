<?php

namespace Cli\Service;

use Cli\Contract\OrderInterface;
use Cli\Contract\ProductInterface;

/**
 * Class Order
 *
 * @package Cli\Service
 */
class Order implements OrderInterface
{
    private array $products;

    /**
     * Order constructor.
     *
     * @param array $products
     */
    public function __construct(array $products = [])
    {
        $this->products = $products;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param ProductInterface $product
     *
     * @return OrderInterface
     */
    public function append(ProductInterface $product): OrderInterface
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * @return float
     */
    public function getSubtotal(): float
    {
        $total = 0.00;

        /** @var ProductInterface $product */
        foreach ($this->products as $product) {
            $total += $product->getPrice();
        }

        return $total;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return ceil($this->getSubtotal());
    }
}
