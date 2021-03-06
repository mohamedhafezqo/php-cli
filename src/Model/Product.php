<?php

namespace Cli\Model;

use Cli\Contract\OfferInterface;
use Cli\Contract\ProductInterface;

/**
 * Class Product
 *
 * @package Cli\Model
 */
class Product implements ProductInterface {

	private string $name;
	private float $price;
	private array $offers;
	private string $currency;

    public function __construct()
    {
        $this->offers = [];
	}

	public function getName(): string
    {
		return $this->name;
	}

	public function setName(string $name): ProductInterface
    {
		$this->name = $name;

		return $this;
	}

	public function getPrice(): float
    {
		return $this->price;
	}

	public function setPrice(float $price): ProductInterface
    {
        $this->price = $price;

	    return $this;
	}

    public function setCurrency(string $currency): ProductInterface
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param OfferInterface $offer
     *
     * @return ProductInterface
     */
    public function appendOffer(OfferInterface $offer): ProductInterface
    {
        $this->offers [] = $offer;

        return $this;
	}

    /**
     * @return bool
     */
    public function hasOffer(): bool
    {
        return count($this->offers);
	}
}
