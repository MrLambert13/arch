<?php

declare(strict_types = 1);

namespace Service\Discount;

/** Реализуем паттерн декоратор, для возможности наложения на товар нескольких скидок. Без усложения кода и кучи наследников.
 * Interface IDiscount
 * @package Service\Discount
 */
interface IDiscount
{
    /**
     * Получаем скидку в процентах
     *
     * @return float
     */
    public function getDiscount(): float;
}
