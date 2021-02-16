<?php

namespace Cli\Service;

/**
 * Class ProductList
 *
 * @package Cli\Service
 */
final class ProductList
{
    const T_SHIRT_NAME = "T-shirt";
    const T_SHIRT_PRICE = 10.99;

    const PANTS_NAME = "Pants";
    const PANTS_PRICE = 14.99;

    const JACKET_NAME = "Jacket";
    const JACKET_PRICE = 19.99;

    const SHOES_NAME = "Shoes";
    const SHOES_PRICE = 24.99;

    const EGP_EXCHANGE = 15.70;

    /**
     * @return array
     */
    public static function getChoices()
    {
        return [
            self::T_SHIRT_NAME => self::T_SHIRT_PRICE,
            self::PANTS_NAME => self::PANTS_PRICE,
            self::JACKET_NAME => self::JACKET_PRICE,
            self::SHOES_NAME => self::SHOES_PRICE,
        ];
    }

    /**
     * @param string $productName
     * @param string $currency
     *
     * @return float|null
     */
    public static function getPrice(string $productName, string $currency): ?float
    {
        $productList = self::getChoices();
        $priceExchange = self::priceExchange($currency);

        return isset($productList[$productName]) ? $productList[$productName] * $priceExchange : null;
    }

    /**
     * @param string $currency
     *
     * @return float
     */
    public static function priceExchange(string $currency): float
    {
        switch ($currency) {
            case "EGP":
                return self::EGP_EXCHANGE;
            default:
                return 1.00;
        }
    }
}
