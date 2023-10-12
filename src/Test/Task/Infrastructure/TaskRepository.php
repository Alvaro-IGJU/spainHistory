<?php

namespace App\Test\Task\Infrastructure;

use App\Entity\Task;
use App\Test\Task\Application\TaskResponse;
use App\Test\Task\Domain\TaskRespository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;


/**
 * @extends ServiceEntityRepository<Task>
 *
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository implements TaskRespository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function getBy(array $criteria):TaskResponse
    {
        $response = $this->findBy($criteria);
        return new TaskResponse($response);
    }
    public function store($task): bool
    {
        try{
            $taskObject = new Task();
            $taskObject->setTitle($task['title']);

            $this->getEntityManager()->persist($taskObject);
          $this->getEntityManager()->flush();
            return true;
        }catch (\Exception $exception){
            throw new Exception($exception->getMessage());
        }

    }


//    /**
//     * @return Task[] Returns an array of Task objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Task
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }



}
