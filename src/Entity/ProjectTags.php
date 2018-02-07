<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectTagsRepository")
 * @ORM\Table(name="project_tags")
 */
class ProjectTags
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Project[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Project", mappedBy="projectTags")
     */
    private $projects;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private $tag;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $modified;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ProjectTags
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Project[]
     */
    public function getProjects(): array
    {
        return $this->projects;
    }

    /**
     * @param Project[] $projects
     * @return ProjectTags
     */
    public function setProjects(array $projects): ProjectTags
    {
        $this->projects = $projects;
        return $this;
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     * @return ProjectTags
     */
    public function setTag(string $tag): ProjectTags
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return ProjectTags
     */
    public function setStatus(int $status): ProjectTags
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return ProjectTags
     */
    public function setCreated(\DateTime $created): ProjectTags
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getModified(): \DateTime
    {
        return $this->modified;
    }

    /**
     * @param \DateTime $modified
     * @return ProjectTags
     */
    public function setModified(\DateTime $modified): ProjectTags
    {
        $this->modified = $modified;
        return $this;
    }

    /**
     * @param Project $project
     */
    public function addProject(Project $project): void
    {
        $this->projects[] = $project;
        $project->addProjectTag($this);
    }

    /**
     * @param Project $project
     */
    public function removeProject(Project $project): void
    {
        if (false !== $key = array_search($project, $this->projects, true)) {
            array_splice($this->projects, $key, 1);
        }
        $project->removeProjectTag($this);
    }
}
