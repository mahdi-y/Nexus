<?php

namespace App\Repository;

use App\Entity\Question;
use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Question>
 *
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function save(Question $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Question $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Question[] Returns an array of Question objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('q')
    //            ->andWhere('q.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('q.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    public function findOneBySomeField($value): ?Question
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function getbyid($id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT q
            FROM App\Entity\Question q
            where q.idQ=:id
            '

        )->setParameter('id', $id);

        return $query->getResult();
    }

    public function getbyname($nom): ?Question
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT q
            FROM App\Entity\Question q
            where q.contenuQ=:nom
            '

        )->setParameter('nom', $nom);

        return $query->getOneOrNullResult();
    }

    public function findByUser($user)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.idU = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
    public function getVotesForQuestion($questionName)
    {
        $query = $this->createQueryBuilder('q')
            ->select('q.voteQ')
            ->andWhere('q.contenuQ = :name')
            ->setParameter('name', $questionName)
            ->getQuery();

        return $query->getSingleScalarResult();
    }
    public function getUIDbyname($nom): ?Utilisateur
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u
        FROM App\Entity\Utilisateur u
        WHERE EXISTS (
            SELECT q
            FROM App\Entity\Question q
            WHERE q.contenuQ = :nom
            AND q.idU = u.idU
        )'
        )->setParameter('nom', $nom);

        return $query->getOneOrNullResult();
    }
}
