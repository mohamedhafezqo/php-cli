<?php

namespace Cli\Service;

use Cli\Contract\OfferFacadeInterface;
use Cli\Offers\BuyTwoTshirtGetJacket50Percent;
use Cli\Offers\Shoes10PercentOff;

/**
 * Class OfferFacade
 *
 * @package Cli\Service
 */
class OfferFacade implements OfferFacadeInterface
{
    /** @var array $registeredOffers */
    private array $registeredOffers;

    public function __construct()
    {
        // Assumptions that we use service tag for DI or fetch the offers from DB
        $this->registeredOffers = [
          new BuyTwoTshirtGetJacket50Percent(),
          new Shoes10PercentOff(),
        ];
    }

    /**
     * @param array $products
     *
     * @return array
     */
    public function apply(array $products): array
    {
        $discounts = [];
        foreach ($this->registeredOffers as $offer) {
            $discounts = array_merge($discounts, $offer->apply($products));
        }

        return $discounts;
    }
}
