<?php

declare(strict_types = 1);

namespace Service\Discount;

use Model;

/**
 * Class VipDiscount - обертка индивидуальной скидки
 * @package Service\Discount
 */
class VipDiscount extends BaseDiscountDecorator
{
    /**
     * @var string
     */
    private $user;


    /**
     * @inheritdoc
     */
    public function getDiscount(): float
    {
        $baseDiscount = parent::getDiscount();
        // Получаем индивидуальную скидку VIP пользователя
        // $discount = $this->find($this->user)->discount();
        $discount = 20;

        return $baseDiscount * $discount / 100;
    }
}
