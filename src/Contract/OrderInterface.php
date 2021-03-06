<?php

namespace Cli\Contract;

/**
 * Interface OrderInterface
 *
 * @package Cli\Contract
 */
interface OrderInterface
{
    /**
     * @return array
     */
    public function getProducts(): array;

    /**
     * @param ProductInterface $product
     *
     * @return OrderInterface
     */
    public function append(ProductInterface $product): OrderInterface;

    /**
     * @return float
     */
    public function getSubtotal(): float;

    /**
     * @return float
     */
    public function getTotal(): float;
}
