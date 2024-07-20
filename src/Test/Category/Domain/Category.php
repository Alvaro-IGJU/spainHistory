<?php

namespace App\Test\Category\Domain;

use App\Repository\CategoryRepository;
use App\Test\Article\Domain\Article;
use App\Test\User\Domain\User;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Article::class, mappedBy: 'categories')]
    private Collection $articles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
    public static function createToObject(array $data): Category{
        $category = new Category();
        $category->setName($data['name']);

        return $category;
    }
}
