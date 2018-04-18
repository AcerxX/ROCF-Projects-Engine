<?php

namespace App\Repository;

use App\Dto\ProjectsListingRequestDto;
use App\Entity\Project;

class ProjectRepository extends BaseRepository
{
    public function getProjectsForListing(ProjectsListingRequestDto $projectsListingRequestDto)
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
                'c.name as project_city_name'
            )
            ->innerJoin('p.city', 'c')
            ->where('p.status = :status')->setParameter('status', Project::STATUS_PUBLISHED)
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(50);

        return $qb->getQuery()
            ->useResultCache(true)
            ->useQueryCache(true)
            ->getResult();
    }
}
