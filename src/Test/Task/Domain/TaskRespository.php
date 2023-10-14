<?php

namespace App\Test\Task\Domain;


use App\Test\Task\Application\DeleteTask\TaskDeleteResponse;
use App\Test\Task\Application\ListTask\TaskResponse;

interface TaskRespository
{
    public function getBy(array $criteria):TaskResponse;
    public function store(array $task):bool;
    public function update(array $task):bool;
    public function  delete(int $id):TaskDeleteResponse;

}