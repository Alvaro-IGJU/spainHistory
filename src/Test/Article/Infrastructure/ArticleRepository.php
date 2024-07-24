<?php
namespace App\Test\Article\Infrastructure;

use App\Test\Article\Application\DeleteArticle\ArticleDeleteResponse;
use App\Test\Article\Application\ListArticle\ArticleResponse;
use App\Test\Article\Domain\Article;
use App\Test\User\Domain\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository implements \App\Test\Article\Domain\ArticleRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function getPaginatedData(int $page, int $itemsPerPage, string $filter = '', int $userId = null): array
    {
        $query = $this->createQueryBuilder('a');

        if ($filter !== '') {
            $query->andWhere('a.title LIKE :filter OR a.content LIKE :filter')
                ->setParameter('filter', '%' . $filter . '%');
        }

        if ($userId !== null && $userId !== 0) {
            $query->andWhere('a.user = :userId')
                ->setParameter('userId', $userId);
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
             * @var Article $item
             */
            $data[] = [
                'id' => $item->getId(),
                'title' => $item->getTitle(),
                'content' => $item->getContent(),
                'user' => ["id" => $item->getUser()->getId(),"name" =>  $item->getUser()->getName(), "photo" => $item->getUser()->getBase64Image()],
            ];
        }

        return [
            'items' => $data,
            'totalProducts' => $paginator->count(),
        ];
    }

    public function getByArticle(array $criteria): ArticleResponse
    {
        // TODO: Implement getByArticle() method.
    }

    public function storeArticle(array $article, UserRepository $userRepository): bool
    {
        try {
            $user = $userRepository->find($article['user_id']);
            if (!$user) {
                return false;
            }

            $articleObject = Article::createToObject($article, $user);

            $entityManager = $this->getEntityManager();
            $entityManager->persist($articleObject);
            $entityManager->flush();

            return true;
        } catch (Exception $exception) {
            throw new Exception('Error al almacenar el artículo: ' . $exception->getMessage());
        }
    }
}

