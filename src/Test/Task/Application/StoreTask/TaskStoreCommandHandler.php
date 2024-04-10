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

            if(is_null($data['id'])){
                $resultResponse = $this->taskRepository->store($data);
            }else{
                $resultResponse=$this->taskRepository->update($data);
            }


        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return new TaskStoreResponse($resultResponse);
    }

}
