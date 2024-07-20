<?php

namespace App\Test\Article\Application\StoreArticle;

class ArticleStoreResponse
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
