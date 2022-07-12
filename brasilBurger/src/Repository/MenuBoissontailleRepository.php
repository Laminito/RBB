<?php

namespace App\Repository;

use App\Entity\MenuBoissontaille;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MenuBoissontaille>
 *
 * @method MenuBoissontaille|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuBoissontaille|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuBoissontaille[]    findAll()
 * @method MenuBoissontaille[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuBoissontailleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MenuBoissontaille::class);
    }

    public function add(MenuBoissontaille $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MenuBoissontaille $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MenuBoissontaille[] Returns an array of MenuBoissontaille objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MenuBoissontaille
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
