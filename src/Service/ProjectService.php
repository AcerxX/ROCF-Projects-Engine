<?php

namespace App\Service;


use App\Dto\ProjectRequestDto;
use App\Entity\City;
use App\Entity\Project;
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
     * @return bool
     */
    public function createProjectForUser(int $userId): bool
    {
        $success = true;

        /** @var EntityManager $entityManager */
        $entityManager = $this->doctrine->getManager();

        try {
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
        } catch (\Exception $e) {
            $success = false;
        }

        return $success;
    }

    private function getDefaultTitle(): string
    {
        return 'Click here to set a title...';
    }

    private function getDefaultShortDescription(): string
    {
        return 'Click here to set a short description. It should not be larger than 1 sentence.';
    }

    private function getDefaultContent(): string
    {
        return '[Click here to set your content]
        
            You can use the toolbar on the right to create beautiful content.
            TODO MORE INSTRUCTIONS.
            
            In order to have a good content please be sure you talk about the following topics:
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
            'expirationDate'=> $project->getExpirationDate()->format('d.m.Y'),
            'userId' => $project->getUserId(),
            'link' => $project->getLink(),
            'presentationMedia' => $project->getPresentationMedia(),
            'content' => $project->getContent(),
            'projectTags' => $project->getProjectTags(),
            'perks' => []
        ];

        foreach ($project->getPerks() as $perk) {
            $formattedProject['perks'][] = UtilsService::formatPerkForResponse($perk);
        }

        return $formattedProject;
    }

    /**
     * @param ProjectRequestDto $projectRequestDto
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    public function updateProject(ProjectRequestDto $projectRequestDto)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->doctrine->getManager();

        $project = $this->getProjectById($projectRequestDto->getProjectId());


    }

    public function updateProjectAttributes(Project $project, ProjectRequestDto $projectRequestDto)
    {

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