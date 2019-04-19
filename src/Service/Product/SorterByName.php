<?php

declare(strict_types=1);

namespace Service\Product;

use Model\Entity\Product;

class SorterByName implements ISorter
{
    /**
     * @inheritdoc
     */
    public function productSort(array $products): array
    {
        $sortFunction = function (Product $a, Product $b) {
            return strcmp($a->getName(), $b->getName());
        };

        usort($products, $sortFunction);

        return $products;
    }
}