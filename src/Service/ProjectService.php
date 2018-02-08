<?php

namespace App\Service;


use App\Entity\City;
use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Symfony\Bridge\Doctrine\RegistryInterface;

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
    public function addProjectForUser(int $userId): bool
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
}