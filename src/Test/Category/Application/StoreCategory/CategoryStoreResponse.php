<?php

namespace App\Test\Category\Application\StoreCategory;

class CategoryStoreResponse
{

    /**
     * @var array $response
     */
    private $response;

    /**
     * @param array $response
     */
    public function __construct(bool $response)
    {
        $this->response = $response;
    }

    public function isResponse(): array
    {
        return $this->response;
    }

}
