<?php

declare(strict_types = 1);

namespace Service\Discount;

/**
 * Class PromoCode - обертка для скидки по промокоду
 * @package Service\Discount
 */
class PromoCode extends BaseDiscountDecorator
{
    /**
     * @var string
     */
        private $promoCode;

    /**
     * @inheritdoc
     */
    public function getDiscount(): float
    {
        $baseDiscount = parent::getDiscount();
        // Дупустим примененный промокод в ЛК пользователя привязывает ему какую то скидку,
        // находим эту скидку
        // $discount = $this->find($this->promoCode)->discount();
        $discount = 0.50;

        // Запрос в систему хранения промокодов для пометки кода как использованный
        // $this->find($this->promoCode)->deactivate();

        return $baseDiscount * $discount;
    }
}
