<?php

namespace App\Test\User\Application\Update;

class UserUpdateResponse
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