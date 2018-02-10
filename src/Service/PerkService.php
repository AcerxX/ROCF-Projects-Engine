<?php

namespace App\Service;


use App\Dto\PerkRequestDto;
use App\Dto\UpdatePerkInfoRequestDto;
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

    /**
     * @param UpdatePerkInfoRequestDto $perkInfoRequestDto
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \RuntimeException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function updatePerk(UpdatePerkInfoRequestDto $perkInfoRequestDto): array
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->doctrine->getManager();
        $perkRepository = $entityManager->getRepository('App:Perk');

        $perkRepository->aquireNamedLock('perk_' . $perkInfoRequestDto->getPerkId());

        $perk = $this->getPerkById($perkInfoRequestDto->getPerkId());
        $this->updatePerkAttributes($perk, $perkInfoRequestDto);

        $entityManager->persist($perk);
        $entityManager->flush();

        $perkRepository->releaseNamedLock('perk_' . $perkInfoRequestDto->getPerkId());

        return UtilsService::formatPerkForResponse($perk);
    }

    /**
     * @param Perk $perk
     * @param UpdatePerkInfoRequestDto $perkInfoRequestDto
     * @throws \RuntimeException
     */
    public function updatePerkAttributes(Perk $perk, UpdatePerkInfoRequestDto $perkInfoRequestDto): void
    {
        if (null !== $perkInfoRequestDto->getTitle()) {
            $perk->setTitle($perkInfoRequestDto->getTitle());
        }

        if (null !== $perkInfoRequestDto->getAmount()) {
            $perk->setAmount($perkInfoRequestDto->getAmount());
        }

        if (null !== $perkInfoRequestDto->getDescription()) {
            $perk->setDescription($perkInfoRequestDto->getDescription());
        }

        if (null !== ($diffQuantity = $perkInfoRequestDto->getDiffQuantity())) {
            if ($diffQuantity < 0 && $perk->getAvailableQuantity() < abs($diffQuantity)) {
                throw new \RuntimeException('Cantitatea ramasa este mai mica decat cantitatea redusa!');
            }

            $perk->setAvailableQuantity($perk->getAvailableQuantity() + $diffQuantity);
            $perk->setTotalQuantity($perk->getTotalQuantity() + $diffQuantity);
        }

        if (null !== $perkInfoRequestDto->getImagePath()) {
            $perk->setImagePath($perkInfoRequestDto->getImagePath());
        }

        if ($perkInfoRequestDto->getUnsetImagePath()) {
            $perk->setImagePath(null);
        }

        if ($perkInfoRequestDto->getUnsetQuantity()) {
            $perk->setTotalQuantity(null);
            $perk->setAvailableQuantity(null);
        }
    }

    /**
     * @param int $perkId
     * @return Perk
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    public function getPerkById(int $perkId): Perk
    {
        /** @var Perk|null $perk */
        $perk = $this->doctrine->getRepository('App:Perk')->findOneBy(
            [
                'id' => $perkId,
                'status' => [Perk::STATUS_ENABLED]
            ]
        );

        if ($perk === null) {
            throw new BadRequestHttpException('Perk with id ' . $perkId . ' does not exits!');
        }

        return $perk;
    }
}