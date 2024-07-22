<?php

namespace App\Test\User\Application\Update;


use App\Test\User\Domain\UserRepository;
use Exception;

class UserUpdateCommandHandler
{

    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handler($data): UserUpdateResponse
    {
        try {

            $resultResponse = $this->userRepository->updateUser($data);

        } catch (\Exception $exception) {
            return new UserUpdateResponse("Error: " . $exception->getMessage());
        }

        return new UserUpdateResponse("Ha actualizado el usuario: " . $resultResponse);
    }
}
