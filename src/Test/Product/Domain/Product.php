<?php

namespace App\Test\Product\Domain;


use App\Test\Product\Application\ListProduct\ProductResponse;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Test\Product\Infrastructure\ProductRepository;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?float $IVA = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getIVA(): ?float
    {
        return $this->IVA;
    }

    public function setIVA(?float $IVA): static
    {
        $this->IVA = $IVA;

        return $this;
    }

    public static function createFromArray(ProductResponse $productResponse)
    {

        $responseArray = [];
        /**
         * @var Product $item
         */
        foreach ($productResponse->getProducts() as $item) {
            $responseArray[] = ['id' => $item->getId(), 'name' => $item->getName(),'description' => $item->getDescription(),'price' => $item->getPrice(),'iva' => $item->getIVA()];
        }
        return $responseArray;

    }


    public static function createToObject($data){

        $product= new Product();
        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setPrice($data['price']);
        $product->setIVA($data['IVA']);
        return $product;

    }
}
