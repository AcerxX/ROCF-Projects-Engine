<?php

namespace App\Service;


use App\Dto\UpdateProjectInfoRequestDto;
use App\Entity\City;
use App\Entity\Perk;
use App\Entity\Project;
use App\Entity\ProjectTag;
use App\Repository\ProjectRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ProjectService
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
     * @param int $userId
     * @return array
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     */
    public function createProjectForUser(int $userId): array
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->doctrine->getManager();

        /** @var City $city */
        $city = $entityManager->getReference('App:City', City::CITY_ID_ALL);

        $newProject = (new Project())
            ->setStatus(Project::STATUS_DRAFT)
            ->setCity($city)
            ->setExpirationDate(new \DateTime('+2 months'))
            ->setUserId($userId)
            ->setLink(UtilsService::generateRandomToken($userId))
            ->setTitle($this->getDefaultTitle())
            ->setContent($this->getDefaultContent())
            ->setShortDescription($this->getDefaultShortDescription());

        $entityManager->persist($newProject);
        $entityManager->flush();

        return $this->formatProjectForResponse($newProject);
    }

    private function getDefaultTitle(): string
    {
        return 'Click aici pentru a seta un titlu...';
    }

    private function getDefaultShortDescription(): string
    {
        return 'Click aici pentru a seta o scurta descriere. Aceasta nu ar trebui sa fie mai lunga de o propozitie.';
    }

    private function getDefaultContent(): string
    {
        return '[Click aici pentru a seta continutul proiectului]
        
            Poti folosi instrumentele de pe bara din dreapta pentru a crea continut spectaculos.
            TODO MORE INSTRUCTIONS.
            
            Pentru a te asigura ca ai un continut bun, asigura-te ca atingi urmatoarele subiecte in descrierea ta:
            TODO LIST
            
            TODO MORE NICE THINGS
            TODO TODO TODOTODOTODOTODO TODOOOO
        ';
    }


    /**
     * @param int $id
     * @param bool $throwException
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    public function getProjectInfo(int $id, bool $throwException = true): array
    {
        /** @var ProjectRepository $projectRepository */
        $projectRepository = $this->doctrine->getRepository('App:Project');
        /** @var Project $project */
        $project = $projectRepository->findOneBy(
            [
                'id' => $id
            ]
        );
        if ($project === null && $throwException) {
            throw new BadRequestHttpException();
        }

        return $this->formatProjectForResponse($project);
    }

    private function formatProjectForResponse(Project $project): array
    {
        $formattedProject = [
            'id' => $project->getId(),
            'title' => $project->getTitle(),
            'shortDescription' => $project->getShortDescription(),
            'totalAmount' => $project->getTotalAmount(),
            'pledgedAmount' => $project->getPledgedAmount(),
            'cardImage' => $project->getCardImage(),
            'city' => $project->getCity()->getCounty()->getName(),
            'expirationDate' => $project->getExpirationDate()->format('d.m.Y'),
            'userId' => $project->getUserId(),
            'link' => $project->getLink(),
            'presentationMedia' => $project->getPresentationMedia(),
            'content' => $project->getContent(),
            'projectTags' => [],
            'perks' => []
        ];


        if ($project->getPerks() !== null) {
            /** @var Perk $perk */
            foreach ($project->getPerks() as $perk) {
                if ($perk->getStatus() === Perk::STATUS_ENABLED) {
                    $formattedProject['perks'][] = UtilsService::formatPerkForResponse($perk);
                }
            }
        }

        if ($project->getProjectTags() !== null) {
            /** @var ProjectTag $tag */
            foreach ($project->getProjectTags() as $tag) {
                if ($tag->getStatus() === ProjectTag::STATUS_ENABLED) {
                    $formattedProject['projectTags'][] = UtilsService::formatTagForResponse($tag);
                }
            }
        }

        return $formattedProject;
    }

    /**
     * @param UpdateProjectInfoRequestDto $projectRequestDto
     * @return array
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateProject(UpdateProjectInfoRequestDto $projectRequestDto): array
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->doctrine->getManager();

        $project = $this->getProjectById($projectRequestDto->getProjectId());
        $this->updateProjectAttributes($project, $projectRequestDto);

        $entityManager->persist($project);
        $entityManager->flush();

        return $this->formatProjectForResponse($project);
    }

    /**
     * @param Project $project
     * @param UpdateProjectInfoRequestDto $projectRequestDto
     */
    public function updateProjectAttributes(Project $project, UpdateProjectInfoRequestDto $projectRequestDto): void
    {
        if (null !== $projectRequestDto->getTitle()) {
            $project->setTitle($projectRequestDto->getTitle());
        }

        if (null !== $projectRequestDto->getShortDescription()) {
            $project->setShortDescription($projectRequestDto->getShortDescription());
        }

        if (null !== $projectRequestDto->getTotalAmount()) {
            $project->setTotalAmount($projectRequestDto->getTotalAmount());
        }

        if (null !== $projectRequestDto->getPresentationMedia()) {
            $project->setPresentationMedia($projectRequestDto->getPresentationMedia());
        }

        if (null !== $projectRequestDto->getContent()) {
            $project->setContent($projectRequestDto->getContent());
        }

        if (null !== $projectRequestDto->getCityId()) {
            $project->setCity(
                $this->doctrine
                    ->getRepository('App:City')
                    ->find($projectRequestDto->getTitle())
            );
        }

        if (null !== $projectRequestDto->getCardImage()) {
            $project->setCardImage($projectRequestDto->getCardImage());
        }

        if (null !== $projectRequestDto->getExpirationDate()) {
            $project->setExpirationDate(
                \DateTime::createFromFormat($projectRequestDto->getExpirationDate(), 'd.m.Y')
            );
        }

        if (null !== $projectRequestDto->getLink()) {
            $project->setLink($projectRequestDto->getLink());
        }

        if ($projectRequestDto->getUnsetCardImage()) {
            $project->setCardImage(null);
        }

        if ($projectRequestDto->getUnsetPresentationMedia()) {
            $project->setPresentationMedia(null);
        }

        if ($projectRequestDto->getUnsetTotalAmount()) {
            $project->setTotalAmount(null);
        }
    }

    /**
     * @param int $projectId
     * @return Project
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    public function getProjectById(int $projectId): Project
    {
        /** @var Project|null $project */
        $project = $this->doctrine->getRepository('App:Project')->findOneBy(
            [
                'id' => $projectId,
                'status' => [Project::STATUS_DRAFT, Project::STATUS_PUBLISHED]
            ]
        );

        if ($project === null) {
            throw new BadRequestHttpException('Project with id ' . $projectId . ' does not exits!');
        }

        return $project;
    }
}