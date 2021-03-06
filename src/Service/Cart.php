<?php

namespace Cli\Service;

use Cli\Constant\Tax;
use Cli\Contract\CartInterface;
use Cli\Contract\OfferFacadeInterface;
use Cli\Contract\OrderInterface;

/**
 * Class Cart
 *
 * @package Cli\Service
 */
class Cart implements CartInterface
{
	private OrderInterface $order;
	private OfferFacadeInterface $offerFacade;
	private string $currency;

    /**
     * Cart constructor.
     *
     * @param OrderInterface       $order
     * @param OfferFacadeInterface $offerFacade
     */
	public function __construct(OrderInterface $order, OfferFacadeInterface $offerFacade)
    {
        $this->order = $order;
        $this->offerFacade = $offerFacade;
    }

    /**
     * @return float
     */
	public function getSubTotal(): float
    {
		return $this->order->getTotal();
	}

    /**
     * @return float
     */
    public function getTaxes(): float
    {
        return round($this->order->getTotal() * Tax::PERCENT, 2);
    }

    /**
     * @return array
     */
    public function getDiscount(): array
    {
        return $this
            ->offerFacade
            ->apply($this->order->getProducts())
        ;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->order->getTotal();
    }

    /**
     * @param string $currency
     *
     * @return CartInterface
     */
    public function setCurrency(string $currency): CartInterface
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return " ".$this->currency;
    }

    /**
     * @return array
     */
	public function checkOut(): array
    {
        return [
            'SubTotal' => $this->getSubTotal() . $this->getCurrency(),
            'Taxes' => $this->getTaxes() . $this->getCurrency(),
            'Discounts' => $this->getDiscount(),
            'Total' => $this->getTotal() + $this->getTaxes() . $this->getCurrency(),
        ];
	}
}
