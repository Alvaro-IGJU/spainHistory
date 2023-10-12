<?php

namespace App\Test\Task\Application\StoreTask;


use App\Test\Task\Infrastructure\TaskRepository;
use Exception;

class TaskStoreCommandHandler
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

    public function handler($data): TaskStoreResponse
    {
        try {

            $resultResponse = $this->taskRepository->store($data);


        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return new TaskStoreResponse($resultResponse);
    }

}