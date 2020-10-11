<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Job;

/**
 * @param int|null $categoryId
 * 
 * @return Job[]
 */
class JobRepository extends EntityRepository
{
    public function findActiveJobs(int $categoryId = null)
    {
        $qb = $this->createQueryBuilder('j')
            ->where('j.expiresAt > :date')
            ->setParameter('date', new \DateTime())
            ->orderBy('j.expiresAt', 'DESC');

        if($categoryId){
            $qb->andWhere('j.category = :categoryId')
                ->setParameter('categoryId', $categoryId);
        }
        return $qb->getQuery()->getResult();
    }

    /**
     * @param integer $id
     *
     * @return Job|null
     */
    public function findActiveJob(int $id): ?Job
    {
        return $this->createQueryBuilder('j')
            ->where('j.id = :id')
            ->andwhere('j.expiresAt > :date')
            ->setParameter('id', $id)
            ->setParameter('date', new \DateTime())
            ->getQuery()
            ->getOneOrNullResult();
    }
}