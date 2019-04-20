<?php

namespace Service\Order;


use Service\Billing\IBilling;
use Service\Communication\ICommunication;
use Service\Discount\IDiscount;
use Service\User\ISecurity;

class CheckoutBuilder
{
    /**
     * @var IBilling
     */
    private $billing;
    /**
     * @var IDiscount
     */
    private $discount;
    /**
     * @var ICommunication
     */
    private $communication;
    /**
     * @var ISecurity
     */
    private $security;

    /**
     * @return IBilling
     */
    public function getBilling(): IBilling
    {
        return $this->billing;
    }

    /**
     * @param IBilling $billing
     */
    public function setBilling(IBilling $billing): void
    {
        $this->billing = new $billing();
    }

    /**
     * @return IDiscount
     */
    public function getDiscount(): IDiscount
    {
        return $this->discount;
    }

    /**
     * @param IDiscount $discount
     */
    public function setDiscount(IDiscount $discount): void
    {
        $this->discount = new $discount();
    }

    /**
     * @return ICommunication
     */
    public function getCommunication(): ICommunication
    {
        return $this->communication;
    }

    /**
     * @param ICommunication $communication
     */
    public function setCommunication(ICommunication $communication): void
    {
        $this->communication = new $communication();
    }

    /**
     * @return ISecurity
     */
    public function getSecurity(): ISecurity
    {
        return $this->security;
    }

    /**
     * @param ISecurity $security
     */
    public function setSecurity(ISecurity $security): void
    {
        $this->security = new $security();
    }

    public function build(): CheckoutBuilder
    {
        return $this;
    }
}
