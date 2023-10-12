<?php

namespace App\Test\Task\Domain;


use App\Test\Task\Application\TaskResponse;

interface TaskRespository
{
    public function getBy(array $criteria):TaskResponse;

    public function store(array $task):bool;

}