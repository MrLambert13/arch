<?php

namespace Service\Order;
class TransactionPattern
{
    public function getGoodsFromBasket()
    {
        // ....
    }

    public function getDiscount()
    {
        // ....
        $checkoutBuilder = new CheckoutBuilder();
        $discount = $checkoutBuilder->getDiscount()->getDiscount();
        return $discount;
    }

    public function calculateOrder()
    {
        // ....
    }

    public function getBilling()
    {
        // ....
    }

    public function removeGoodsFromStock()
    {
        // ....
    }

    public function dispatchOrder()
    {
        // ....
    }
}