<?php

namespace App\Test\Task\Application;


use App\Test\Task\Domain\Task;
use App\Test\Task\Infrastructure\TaskRepository;
use Exception;

class TaskCommandHandler
{
    /**
     * @var TaskRepository $taskRepository
     */
    private $taskRepository;

    /**
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }


    public function handler(array $criteria): TaskResponse
    {
        try {

            $taskResponse = $this->taskRepository->getBy($criteria);
            $result=Task::createFromArray($taskResponse);

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return new TaskResponse($result);
    }


}