#!/usr/bin/env php
<?php

declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';

use Cli\Service\Order;
use Cli\Service\Cart;
use Cli\Model\Product;
use Cli\Service\ProductList;
use Cli\Service\OfferFacade;


isEmptyCart($argv);
$currency = getCurrency($argv);
$cart = fillCart($argv, $currency);

echo (json_encode($cart->checkOut(), JSON_PRETTY_PRINT));

exit;

function fillCart($argv, $currency) {
    $order = new Order();
    foreach ($argv as $key => $value) {
        $value = ucfirst($value);

        if (!isProductExist($value)) {
            continue;
        }

        $product = new Product();
        $product
            ->setName($value)
            ->setPrice(ProductList::getPrice($value, $currency))
            ->setCurrency($currency)
        ;
        $order->append($product);
    }

    $cart = new Cart($order, new OfferFacade());
    $cart->setCurrency($currency);

    return $cart;
}

function isEmptyCart(&$argv) {
    array_shift($argv);
    if (count($argv) < 1) {
        echo 'Empty Cart' . PHP_EOL;
        exit();
    }
}

function isProductExist($productName)
{
    return array_key_exists($productName, ProductList::getChoices());
}

function getCurrency(&$argv) {
    $data = explode('=', $argv[0]);
    if ($data[1]) {
        array_shift($argv);
    }

    return $data[1] ?? "USD";
}