<?php

declare(strict_types=1);

namespace Cli\Contract;

/**
 * Interface OfferFacadeInterface
 *
 * @package Cli\Contract
 */
interface OfferFacadeInterface
{
    /**
     * @param array $products
     *
     * @return array
     */
    public function apply(array $products): array;
}
