<?php

namespace App\Test\Task\Application\DeleteTask;

use App\Test\Task\Infrastructure\TaskRepository;
use Exception;

class TaskDeleteCommandHandler
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


    public function handler($id):TaskDeleteResponse
    {
        try {

            $taskResponse = $this->taskRepository->delete($id);

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return new TaskDeleteResponse($taskResponse->isResponse());

    }




}