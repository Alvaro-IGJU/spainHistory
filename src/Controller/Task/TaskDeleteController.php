<?php

namespace App\Controller\Task;

use App\Test\Task\Application\DeleteTask\TaskDeleteCommandHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskDeleteController
{

    private $handler;

    /**
     * @param TaskDeleteCommandHandler $handler
     */
    public function __construct(TaskDeleteCommandHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): Response
    {

        $items = ($request->getContent());
        $data = json_decode($items, true);
        $response = $this->handler->handler($data['delete']);
        return new JsonResponse($response);
    }


}