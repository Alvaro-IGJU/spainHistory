<?php

namespace App\Test\Product\Infrastructure;

use App\Test\Product\Application\DeleteProduct\ProductDeleteResponse;
use App\Test\Product\Application\ListProduct\ProductResponse;
use App\Test\Product\Domain\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository implements \App\Test\Product\Domain\ProductRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }


    public function getPaginatedData(int $page, int $itemsPerPage, string $filter): array
    {
        $query = $this->createQueryBuilder('e');
                 if ($filter != '') {
                     $query->andWhere('e.name LIKE :filter')->orWhere('e.description LIKE :filter')
                         ->setParameter('filter', '%' . $filter . '%');
                 }
            $query->orderBy('e.id', 'ASC')
                ->getQuery();

        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult(($page - 1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage);

        $data = [];
        foreach ($paginator as $item) {
            $data[] = [
                'id' => $item->getId(),
                'name' => $item->getName(),
                'price' => $item->getPrice(),
                'description' => $item->getDescription(),
                'iva' => $item->getIva(),
            ];
        }
        return [
            'items' => $data,
            'totalProducts' => $paginator->count(),
        ];
    }


    public function getByProduct(array $criteria): ProductResponse
    {
        $response = $this->findBy($criteria);
        return new ProductResponse($response);
    }

    public function storeProduct(array $product): bool
    {
        try {

            $productObject = Product::createToObject($product);
            $this->getEntityManager()->persist($productObject);
            $this->getEntityManager()->flush();
            return true;
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function updateProduct(array $product): bool
    {
        // TODO: Implement updateProduct() method.
    }

    public function deleteProduct(int $id): ProductDeleteResponse
    {
        try {

            $productDelete= $this->getEntityManager()->find(Product::class,$id);
            if($productDelete){
                $this->getEntityManager()->remove($productDelete);
                $this->getEntityManager()->flush();
                return new ProductDeleteResponse(true);
            }

        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
        return new ProductDeleteResponse(false);
    }
}
