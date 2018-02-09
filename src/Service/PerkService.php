<?php

namespace App\Service;


use App\Dto\PerkRequestDto;
use App\Entity\Perk;
use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PerkService
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var ProjectService
     */
    private $projectService;

    public function __construct(RegistryInterface $doctrine, ProjectService $projectService)
    {
        $this->doctrine = $doctrine;
        $this->projectService = $projectService;
    }

    /**
     * @param PerkRequestDto $perkRequestDto
     * @return array
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @throws \Doctrine\ORM\ORMException
     */
    public function addPerk(PerkRequestDto $perkRequestDto): array
    {
       /** @var EntityManager $entityManager */
       $entityManager = $this->doctrine->getManager();

       $perk = (new Perk())
           ->setTitle($perkRequestDto->getTitle())
           ->setAmount($perkRequestDto->getAmount())
           ->setStatus(Perk::STATUS_ENABLED)
           ->setDescription($perkRequestDto->getDescription())
           ->setImagePath($perkRequestDto->getImagePath())
           ->setTotalQuantity($perkRequestDto->getTotalQuantity())
           ->setAvailableQuantity($perkRequestDto->getTotalQuantity())
           ->setProject($this->projectService->getProjectById($perkRequestDto->getProjectId()));

       $entityManager->persist($perk);
       $entityManager->flush();

       return UtilsService::formatPerkForResponse($perk);
   }
}