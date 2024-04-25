<?php

namespace App\Controller\Task;

use App\Test\Task\Application\StoreTask\TaskStoreCommandHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class TaskStoreController
{


    private $handler;

    public function __construct(TaskStoreCommandHandler $handler)
    {
        $this->handler = $handler;
    }
    public function __invoke(Request $request):JsonResponse
    {
        $items = ($request->getContent());
        $data = json_decode($items, true);
        $response = $this->handler->handler($data);
        return new JsonResponse($response->isResponse());
    }

}
