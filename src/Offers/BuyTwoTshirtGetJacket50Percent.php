<?php

namespace Cli\Offers;

use Cli\Contract\OfferInterface;
use Cli\Contract\ProductInterface;
use Cli\Service\ProductList;

/**
 * Class BuyTwoTshirtGetJacket50Percent
 *
 * @package Cli\Offers
 */
class BuyTwoTshirtGetJacket50Percent implements OfferInterface
{
    const DISCOUNT_PERCENT = .50;

    private $rules = [
        't_shirt_quantity' => 2,
        'order_has_jacket' => true,
    ];

    /**
     * @param mixed $products
     *
     * @return bool
     */
	public function isApplicable($products): bool
    {
        $count = 0;
        $orderHasJacket = false;

        /** @var ProductInterface $product */
        foreach ($products as $product) {
            if ($product->getName() == ProductList::T_SHIRT_NAME) {
                $count++;
            }

            if ($product->getName() == ProductList::JACKET_NAME) {
                $orderHasJacket = true;
            }
        }

        return $this->rules['t_shirt_quantity'] <= $count
            && $orderHasJacket;
    }

	public function apply(array $products): array
    {
        $discounts = [];
        $count = 0;
        if ($this->isApplicable($products)) {
            /** @var ProductInterface $product */
            foreach ($products as $product) {
                if ($product->getName() == ProductList::T_SHIRT_NAME
                    && $count <= $this->rules['t_shirt_quantity'])
                {
                    $product->appendOffer($this);
                    $count++;
                }

                if ($product->getName() == ProductList::JACKET_NAME) {
                    $discount = $product->getPrice() * self::DISCOUNT_PERCENT;
                    $product->appendOffer($this)
                        ->setPrice($discount)
                    ;
                    $discounts[] = $this->prepareDiscountMessage($product, $discount);
                }
            }
        }

        return $discounts;
    }

    /**
     * @param ProductInterface $product
     * @param float $discount
     *
     * @return string
     */
    private function prepareDiscountMessage(ProductInterface $product, float $discount): string
    {
        return sprintf(
            "%d%% off %s: -%.3f %s",
            self::DISCOUNT_PERCENT * 100,
            $product->getName(),
            $discount,
            $product->getCurrency(),
        );
    }
}
