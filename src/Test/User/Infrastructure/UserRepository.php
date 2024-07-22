<?php

namespace App\Test\User\Infrastructure;

use App\Test\User\Domain\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
* @implements PasswordUpgraderInterface<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface,\App\Test\User\Domain\UserRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function addUser(User $user): bool
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return true;
    }

    public function updateUser(array $userData): bool
    {
        $entityManager = $this->getEntityManager();
        $user = $entityManager->getRepository(User::class)->find($userData["id"]);
        if (!$user) {
            return false;
        }

        if (isset($userData['email'])) {
            $user->setEmail($userData['email']);
        }

        if (isset($userData['roles'])) {
            $user->setRoles($userData['roles']);
        }

        if (isset($userData['password'])) {
            $user->setPassword($userData['password']);
        }

        if (isset($userData['name'])) {
            $user->setName($userData['name']);
        }

        if (isset($userData['base64Image'])) {
            $user->setBase64Image($userData['base64Image']);
        }

        if (isset($userData['username'])) {
            $user->setUsername($userData['username']);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return true;
    }

}
