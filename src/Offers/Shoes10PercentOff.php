<?php


namespace Cli\Offers;

use Cli\Contract\OfferInterface;
use Cli\Contract\ProductInterface;
use Cli\Service\ProductList;

/**
 * Class Shoes10PrecentOff
 *
 * @package Cli\Offers
 */
class Shoes10PercentOff implements OfferInterface
{
    const DISCOUNT_PERCENT = .10;

    /**
     * @param mixed $product
     *
     * @return bool
     */
    public function isApplicable($product): bool
    {
        return $product->getName() == ProductList::SHOES_NAME
            && !$product->hasOffer()
        ;
    }

    public function apply(array $products): array
    {
        $discounts = [];
        /** @var ProductInterface $product */
        foreach ($products as $product) {
            if ($this->isApplicable($product)) {
                $product->appendOffer($this);
                $discount = $product->getPrice() * self::DISCOUNT_PERCENT;
                $product->setPrice($product->getPrice() - $discount);
                $discounts[] = $this->prepareDiscountMessage($product, $discount);
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
