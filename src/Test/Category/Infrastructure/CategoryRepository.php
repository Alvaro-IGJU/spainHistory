<?php

namespace App\Test\Category\Infrastructure;

use App\Test\Category\Application\ListCategory\CategoryResponse;
use App\Test\Category\Domain\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository implements \App\Test\Category\Domain\CategoryRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);

    }


    public function getPaginatedData(int $page, int $itemsPerPage, string $filter): array
    {
        $query = $this->createQueryBuilder('a');
        if ($filter != '') {
            $query->andWhere('a.title LIKE :filter')->orWhere('a.content LIKE :filter')
                ->setParameter('filter', '%' . $filter . '%');
        }
        $query->orderBy('a.id', 'ASC')
            ->getQuery();

        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult(($page - 1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage);

        $data = [];
        foreach ($paginator as $item) {
            /**
             * @var Category $item
             */
            $data[] = [
                'id' => $item->getId(),
                'name' => $item->getName(),
            ];
        }
        return [
            'items' => $data,
            'totalCategories' => $paginator->count(),
        ];
    }

    public function storeCategory(array $category): bool
    {
        try{
            $categoryObject = Category::createToObject($category);
            $this->getEntityManager()->persist($categoryObject);
            $this->getEntityManager()->flush();
            return true;
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    public function getCategory(array $criteria): CategoryResponse
    {
        $response = $this->findBy($criteria);
        return new CategoryResponse($response);    }
}
