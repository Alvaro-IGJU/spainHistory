<?php

namespace App\Test\User\Domain;

use App\Test\Article\Domain\Article;
use App\Test\User\Infrastructure\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface,PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private ?string $email;

    #[ORM\Column(type: 'json')]
    private array $roles = [];
    /**
     * @var string The hashed password
     */
    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $base64Image = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $bannerPhoto = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Article::class)]
    private Collection $articles;


    public function getId(): ?int
    {
        return $this->id;
    }
 private ?string $username = null;
    public function __toString(): string
    {
        return $this->email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function getBase64Image(): ?string
    {
        return $this->base64Image;
    }

    public function setBase64Image(?string $base64Image): self
    {
        $this->base64Image = $base64Image;

        return $this;
    }

    public function getBannerPhoto(): ?string
    {
        return $this->bannerPhoto;
    }

    public function setBannerPhoto(?string $bannerPhoto): self
    {
        $this->bannerPhoto = $bannerPhoto;

        return $this;
    }

    public static function createToObject(array $data): User
    {
        $user = new User();

        if (isset($data['email'])) {
            $user->setEmail($data['email']);
        }

        if (isset($data['roles'])) {
            $user->setRoles($data['roles']);
        }

        if (isset($data['password'])) {
            $user->setPassword($data['password']);
        }

        if (isset($data['name'])) {
            $user->setName($data['name']);
        }

        if (isset($data['photo_profile'])) {
            $user->setBase64Image($data['photo_profile']);
        }

        if (isset($data['photo_banner'])) {
            $user->setBannerPhoto($data['photo_banner']);
        }

        if (isset($data['username'])) {
            $user->setUsername($data['username']);
        }

        return $user;
    }
}
