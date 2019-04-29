<?php


namespace Service\Discount;

/**
 * Class BaseDiscountDecorator - базовый класс оберток
 * @package Service\Discount
 */
class BaseDiscountDecorator implements IDiscount
{
    protected $wrappee;

    /**
     * BaseDiscountDecorator constructor.
     *
     * @param IDiscount $wrappee
     */
    public function __construct(IDiscount $wrappee)
    {
        $this->wrappee = $wrappee;
    }


    public function getDiscount(): float
    {
        // Скидка отсутствует
        return $this->wrappee->getDiscount();
    }

}