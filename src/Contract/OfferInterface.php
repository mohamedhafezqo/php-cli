<?php

namespace Cli\Contract;

use phpDocumentor\Reflection\Types\Mixed_;

/**
 * Interface OfferInterface
 *
 * @package Cli\Contract
 */
interface OfferInterface
{
    /**
     * @param mixed $data
     *
     * @return bool
     */
	public function isApplicable($data): bool;

    /**
     * @return mixed
     */
	public function apply(array $products);
}