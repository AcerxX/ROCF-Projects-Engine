<?php

namespace App\Repository;

use App\Dto\ProjectsListingRequestDto;
use App\Entity\Project;

class ProjectRepository extends BaseRepository
{
    public function getRecommendedProjectsForListing(ProjectsListingRequestDto $projectsListingRequestDto)
    {
        $qb = $this->createQueryBuilder('p')
            ->select(
                'p.id as project_id',
                'p.cardImage as project_image',
                'p.shortDescription as short_description',
                'p.title as project_title',
                'p.userId',
                'p.pledgedAmount as project_pledged_amount',
                'p.totalAmount as project_total_amount',
                'city.name as project_city_name',
                'p.cardImage as card_image',
                'category.id as category_id',
                'category.nameRo as category_name_ro'
            )
            ->innerJoin('p.city', 'city')
            ->innerJoin('p.category', 'category')
            ->where('p.status IN (:status)')->setParameter('status', [Project::STATUS_DRAFT, Project::STATUS_PUBLISHED])
            ->andWhere('p.expirationDate > :now')->setParameter('now', new \DateTime())
            ->andWhere('p.pledgedAmount < p.totalAmount')
            ->orderBy('p.id', 'DESC');

        return $qb->getQuery()
            ->useResultCache(true)
            ->useQueryCache(true)
            ->getResult();
    }

    public function getCompletedProjectsForListing(ProjectsListingRequestDto $projectsListingRequestDto)
    {
        $qb = $this->createQueryBuilder('p')
            ->select(
                'p.id as project_id',
                'p.cardImage as project_image',
                'p.shortDescription as short_description',
                'p.title as project_title',
                'p.userId',
                'p.pledgedAmount as project_pledged_amount',
                'p.totalAmount as project_total_amount',
                'city.name as project_city_name',
                'p.cardImage as card_image',
                'category.id as category_id',
                'category.nameRo as category_name_ro'
            )
            ->innerJoin('p.city', 'city')
            ->innerJoin('p.category', 'category')
            ->where('p.status = :status')->setParameter('status', Project::STATUS_PUBLISHED)
            ->andWhere('p.expirationDate > :now')->setParameter('now', new \DateTime())
            ->andWhere('p.pledgedAmount >= p.totalAmount')
            ->orderBy('p.id', 'DESC');

        return $qb->getQuery()
            ->useResultCache(true)
            ->useQueryCache(true)
            ->getResult();
    }
}
