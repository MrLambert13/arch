<?php


namespace Service\Product;


interface ISorter
{
    /**
     * @param array $product
     *
     * @return array
     */
    public function productSort(array $product): array;
}