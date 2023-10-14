<?php

namespace App\Test\User\Application\Registration;

class RegistrationResponse
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