<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectTagRepository")
 * @ORM\Table(name="project_tags")
 * @ORM\HasLifecycleCallbacks()
 */
class ProjectTag
{
    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 0;

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
     * @return ProjectTag
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
     * @return ProjectTag
     */
    public function setProjects(array $projects): ProjectTag
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
     * @return ProjectTag
     */
    public function setTag(string $tag): ProjectTag
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
     * @return ProjectTag
     */
    public function setStatus(int $status): ProjectTag
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
     * @return ProjectTag
     */
    public function setCreated(\DateTime $created): ProjectTag
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
     * @return ProjectTag
     */
    public function setModified(\DateTime $modified): ProjectTag
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

    /**
     * @ORM\PrePersist()
     */
    public function setDates(): void
    {
        if (!($this->created instanceof \DateTime)) {
            $this->created = new \DateTime();
        }

        $this->modified = new \DateTime();
    }
}
