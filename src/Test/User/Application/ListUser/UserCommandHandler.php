<?php
namespace App\Test\User\Application\ListUser;

use App\Test\User\Application\ListUser\UserResponse;
use App\Test\User\Domain\User;
use App\Test\User\Infrastructure\UserRepository;
use Exception;

class UserCommandHandler
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handler(array $criteria): UserResponse
    {
        try {
            $articleResponse = $this->userRepository->getPaginatedData($criteria['page'],$criteria['itemsPerPage'],$criteria['filter'],$criteria['userId']);

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return new UserResponse($articleResponse);
    }
}
