<?php

namespace App\Test\Product\Application\DeleteProduct;

class ProductDeleteResponse
{

    /**
     * @var bool $response
     */
    private $response;

    /**
     * @param bool $response
     */
    public function __construct(bool $response)
    {
        $this->response = $response;
    }

    public function isResponse(): bool
    {
        return $this->response;
    }


}
