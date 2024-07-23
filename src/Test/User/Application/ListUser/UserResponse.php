<?php

namespace App\Test\User\Application\ListUser;

class UserResponse
{

    /**
     * @var array $user
     */
    private $user;

    /**
     * @param array $user
     */
    public function __construct(array $user)
    {
        $this->user = $user;
    }

    public function getUsers(): array
    {
        return $this->user;
    }

}
