<?php

namespace App\Test\Article\Domain;

use App\Test\User\Domain\User;
use App\Test\Category\Domain\Category;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'articles')]
    private User $user;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'articles')]
    #[ORM\JoinTable(name: 'article_category')]
    private Collection $categories;


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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getUser(): ?User{
        return $this->user;
    }

    public function setUser(User $user): self{
        $this->user = $user;

        return $this;
    }

    public static function createToObject(array $data, User $user): Article{
        $article = new Article();
        $article->setTitle($data['title']);
        $article->setContent($data['content']);
        $article->setUser($user);

        return $article;
    }

}
