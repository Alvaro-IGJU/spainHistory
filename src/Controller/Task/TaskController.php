<?php

namespace App\Controller\Task;

use App\Test\Task\Application\ListTask\TaskCommandHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class TaskController extends AbstractController
{


    private $handler;

    /**
     * @param TaskCommandHandler $handler
     */
    public function __construct(TaskCommandHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(): Response
    {
        $response = $this->handler->handler([]);
        return new JsonResponse(['listTask' => $response->getTask()]);

    }


}
