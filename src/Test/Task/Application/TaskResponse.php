<?php

namespace App\Test\Task\Application;
class TaskResponse
{
    /**
     * @var array $task
     */
    private $task;

    /**
     * @param array $task
     */
    public function __construct(array $task)
    {
        $this->task = $task;
    }

    public function getTask(): array
    {
        return $this->task;
    }


}