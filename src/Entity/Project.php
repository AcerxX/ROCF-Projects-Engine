<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 * @ORM\Table(name="project")
 * @ORM\HasLifecycleCallbacks()
 */
class Project
{
    public const STATUS_DISABLED = 0;
    public const STATUS_DRAFT = 1;
    public const STATUS_PUBLISHED = 2;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private $shortDescription;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $totalAmmount;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $pledgedAmmount;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $cardImage;

    /**
     * @var Location
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Location")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     */
    private $location;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $expirationDate;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $presentationMedia;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $content;

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
     * @var ProjectTag[]
     * @ORM\ManyToMany(targetEntity="App\Entity\ProjectTag", inversedBy="projects")
     * @ORM\JoinTable(name="projects_to_tags")
     */
    private $projectTags;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Project
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Project
     */
    public function setTitle(string $title): Project
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     * @return Project
     */
    public function setShortDescription(string $shortDescription): Project
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalAmmount(): int
    {
        return $this->totalAmmount;
    }

    /**
     * @param int $totalAmmount
     * @return Project
     */
    public function setTotalAmmount(int $totalAmmount): Project
    {
        $this->totalAmmount = $totalAmmount;
        return $this;
    }

    /**
     * @return int
     */
    public function getPledgedAmmount(): int
    {
        return $this->pledgedAmmount;
    }

    /**
     * @param int $pledgedAmmount
     * @return Project
     */
    public function setPledgedAmmount(int $pledgedAmmount): Project
    {
        $this->pledgedAmmount = $pledgedAmmount;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return Project
     */
    public function setUserId(int $userId): Project
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPresentationMedia(): string
    {
        return $this->presentationMedia;
    }

    /**
     * @param string $presentationMedia
     * @return Project
     */
    public function setPresentationMedia(string $presentationMedia): Project
    {
        $this->presentationMedia = $presentationMedia;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Project
     */
    public function setContent(string $content): Project
    {
        $this->content = $content;
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
     * @return Project
     */
    public function setStatus(int $status): Project
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
     * @return Project
     */
    public function setCreated(\DateTime $created): Project
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
     * @return Project
     */
    public function setModified(\DateTime $modified): Project
    {
        $this->modified = $modified;
        return $this;
    }

    /**
     * @return ProjectTag[]
     */
    public function getProjectTags(): array
    {
        return $this->projectTags;
    }

    /**
     * @param ProjectTag[] $projectTags
     * @return Project
     */
    public function setProjectTags(array $projectTags): Project
    {
        $this->projectTags = $projectTags;
        return $this;
    }

    /**
     * @param ProjectTag $projectTag
     */
    public function addProjectTag(ProjectTag $projectTag): void
    {
        $this->projectTags[] = $projectTag;
        $projectTag->addProject($this);
    }

    /**
     * @param ProjectTag $projectTag
     */
    public function removeProjectTag(ProjectTag $projectTag): void
    {
        if (false !== $key = array_search($projectTag, $this->projectTags, true)) {
            array_splice($this->projectTags, $key, 1);
        }
        $projectTag->removeProject($this);
    }

    /**
     * @return string
     */
    public function getCardImage(): string
    {
        return $this->cardImage;
    }

    /**
     * @param string $cardImage
     * @return Project
     */
    public function setCardImage(string $cardImage): Project
    {
        $this->cardImage = $cardImage;
        return $this;
    }

    /**
     * @return Location
     */
    public function getLocation(): Location
    {
        return $this->location;
    }

    /**
     * @param Location $location
     * @return Project
     */
    public function setLocation(Location $location): Project
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpirationDate(): \DateTime
    {
        return $this->expirationDate;
    }

    /**
     * @param \DateTime $expirationDate
     * @return Project
     */
    public function setExpirationDate(\DateTime $expirationDate): Project
    {
        $this->expirationDate = $expirationDate;
        return $this;
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
