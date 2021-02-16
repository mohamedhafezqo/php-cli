<?php

namespace Cli\Contract;

use Cli\Contract\OfferInterface;

/**
 * Interface ProductInterface
 *
 * @package Cli\Contract
 */
interface ProductInterface
{
    /**
     * @return string
     */
	public function getName(): string;

    /**
     * @param string $name
     *
     * @return $this
     */
	public function setName(string $name): self;

    /**
     * @return float
     */
	public function getPrice(): float ;

    /**
     * @param float $price
     *
     * @return $this
     */
	public function setPrice(float $price): self;

    /**
     * @param string $currency
     *
     * @return $this
     */
	public function setCurrency(string $currency): self;

    /**
     * @return string
     */
	public function getCurrency(): string;

    /**
     * @param OfferInterface $offer
     *
     * @return $this
     */
    public function appendOffer(OfferInterface $offer): self;

    /**
     * @return bool
     */
    public function hasOffer(): bool;
}