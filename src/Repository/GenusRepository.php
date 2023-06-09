<?php

namespace App\Repository;

use App\Entity\Genus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Genus>
 *
 * @method Genus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genus[]    findAll()
 * @method Genus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genus::class);
    }

    public function save(Genus $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Genus $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByName(string $value): ?Genus
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.name = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
