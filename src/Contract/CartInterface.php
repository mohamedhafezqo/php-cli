<?php

namespace Cli\Contract;

/**
 * Class CartInterface
 *
 * @package Cli\Contract
 */
interface CartInterface
{
    /**
     * @return float
     */
    public function getSubTotal(): float;

    /**
     * @return float
     */
    public function getTaxes(): float;

    /**
     * @return array
     */
    public function getDiscount(): array ;

    /**
     * @return float
     */
    public function getTotal(): float;

    /**
     * @return array
     */
    public function checkOut(): array;

    /**
     * @return string
     */
    public function getCurrency(): string;

    /**
     * @param string $currency
     *
     * @return CartInterface
     */
    public function setCurrency(string $currency): CartInterface;
}
