<?php

namespace App\Test\Product\Application\ListProduct;

class ProductResponse
{

    /**
     * @var array $product
     */
    private $product;

    /**
     * @param array $product
     */
    public function __construct(array $product)
    {
        $this->product = $product;
    }

    public function getProducts(): array
    {
        return $this->product;
    }

}
