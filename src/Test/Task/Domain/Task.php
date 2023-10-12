<?php

namespace App\Test\Task\Domain;

use App\Test\Task\Application\TaskResponse;

class Task
{
    /**
     * @var int|null $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @param int|null $id
     * @param string $title
     */
    public function __construct(?int $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }



    public function getTitle(): string
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public static function createFromArray(TaskResponse $tasks)
    {

        $responseArray = [];
        /**
         * @var Task $item
         */
        foreach ($tasks->getTask() as $item) {
            $responseArray[] = ['id' => $item->getId(), 'title' => $item->getTitle()];
        }
        return $responseArray;

    }

    public static function createToObject($data){

        return  new self(null,$data['title']);

    }


}