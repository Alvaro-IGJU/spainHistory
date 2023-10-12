<?php

namespace App\Test\Task\Application\StoreTask;

class TaskStoreResponse
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