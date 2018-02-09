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

    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
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
       /** @var Project|null $project */
       $project = $entityManager->getRepository('App:Project')->findOneBy(
           [
               'id' => $perkRequestDto->getProjectId(),
               'status' => [Project::STATUS_DRAFT, Project::STATUS_PUBLISHED]
           ]
       );

       if (false === ($project instanceof Project)) {
           throw new BadRequestHttpException('Project with id ' . $perkRequestDto->getProjectId() . ' does not exits!');
       }

       $perk = (new Perk())
           ->setTitle($perkRequestDto->getTitle())
           ->setAmount($perkRequestDto->getAmount())
           ->setStatus(Perk::STATUS_ENABLED)
           ->setDescription($perkRequestDto->getDescription())
           ->setImagePath($perkRequestDto->getImagePath())
           ->setTotalQuantity($perkRequestDto->getTotalQuantity())
           ->setAvailableQuantity($perkRequestDto->getTotalQuantity())
           ->setProject($project);

       $entityManager->persist($perk);
       $entityManager->flush();

       return $this->formatPerkForResponse($perk);
   }

    /**
     * @param Perk $perk
     * @return array
     */
   public function formatPerkForResponse(Perk $perk): array
   {
       return [
           'id' => $perk->getId(),
           'title' => $perk->getTitle(),
           'amount' => $perk->getAmount(),
           'description' => $perk->getDescription(),
           'available_quantity' => $perk->getAvailableQuantity(),
           'total_quantity' => $perk->getTotalQuantity()
       ];
   }
}