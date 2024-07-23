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
        // Obtiene el contenido del cuerpo de la solicitud
        $items = $request->getContent();

        // Decodifica el JSON
        $data = json_decode($items, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new JsonResponse([
                'error' => 'Invalid JSON',
                'message' => json_last_error_msg()
            ], 400);
        }

        if (is_null($data)) {
            return new JsonResponse([
                'error' => 'Decoded data is null'
            ], 400);
        }

        $response = $this->updateHandler->handler($data);

        return new JsonResponse($response->isResponse());
    }

}
