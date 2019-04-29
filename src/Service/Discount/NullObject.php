<?php

declare(strict_types = 1);

namespace Service\Discount;

/**
 * Class NullObject выступает в качестве конкретного компонента
 * @package Service\Discount
 */
class NullObject implements IDiscount
{
    /**
     * @inheritdoc
     */
    public function getDiscount(): float
    {
        // Скидка отсутствует
        return 0;
    }
}
