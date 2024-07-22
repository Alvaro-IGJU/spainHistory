<?php

namespace App\Controller\User;

use App\Test\User\Application\Update\UserUpdateCommandHandler;
use App\Test\User\Domain\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserUpdateController
{
    /**
     * @var UserUpdateCommandHandler $updateHandler
     */
    private $updateHandler;

    /**
     * @param UserUpdateCommandHandler $updateHandler
     */
    public function __construct(UserUpdateCommandHandler $updateHandler)
    {
        $this->updateHandler = $updateHandler;
    }

    public function __invoke(Request $request): Response
    {
        $items = ($request->getContent());
        $data = json_decode($items, true);
        $response = $this->updateHandler->handler($data);

        return new JsonResponse($response->isResponse());
    }
}
