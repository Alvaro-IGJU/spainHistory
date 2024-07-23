<?php
namespace App\Controller\User;

use App\Test\User\Application\ListUser\UserCommandHandler;
use App\Test\User\Application\ListUser\UserResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    private UserCommandHandler $handler;

    public function __construct(UserCommandHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $page = $request->query->getInt('page', 1);
        $itemsPerPage = $request->query->getInt('itemsPerPage', 10);
        $filter = $request->query->get('filter', '');
        $id = $request->query->get('id');

        // Convertir el id a entero, o establecer null si no está presente o no es válido
        $userId = filter_var($id, FILTER_VALIDATE_INT, ["options" => ["default" => null]]);

        $criteria = [
            'page' => $page,
            'itemsPerPage' => $itemsPerPage,
            'filter' => $filter,
            'userId' => $userId
        ];

        try {
            $response = $this->handler->handler($criteria);

            if ($response->getUsers() === null) {
                return new JsonResponse(['error' => 'No users found or an error occurred'], Response::HTTP_NOT_FOUND);
            }

            return new JsonResponse(['listUsers' => $response->getUsers()]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

