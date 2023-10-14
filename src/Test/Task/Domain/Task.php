<?php

namespace App\Test\Task\Domain;

use App\Test\Task\Application\ListTask\TaskResponse;
use App\Test\Task\Infrastructure\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
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

       $task= new Task();
       $task->setTitle($data['title']);
       return $task;

    }
}
