<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

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
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="projects")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

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
    private $totalAmount = 500;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $pledgedAmount = 0;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $cardImage = 'http://www.erpnews.com/wp-content/uploads/2018/04/project-based-ERP-600.jpg   ';

    /**
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

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
     * @ORM\Column(type="string", length=32)
     */
    private $link;

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
     * @var PersistentCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\ProjectTag", inversedBy="projects")
     * @ORM\JoinTable(name="projects_to_tags")
     */
    private $projectTags;

    /**
     * @var PersistentCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Perk", mappedBy="project")
     */
    private $perks;

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
    public function getTotalAmount(): ?int
    {
        return $this->totalAmount;
    }

    /**
     * @param int|null $totalAmount
     * @return Project
     */
    public function setTotalAmount(?int $totalAmount): Project
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    /**
     * @return int
     */
    public function getPledgedAmount(): int
    {
        return $this->pledgedAmount;
    }

    /**
     * @param int $pledgedAmount
     * @return Project
     */
    public function setPledgedAmount(int $pledgedAmount): Project
    {
        $this->pledgedAmount = $pledgedAmount;
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
    public function getPresentationMedia(): ?string
    {
        return $this->presentationMedia;
    }

    /**
     * @param string|null $presentationMedia
     * @return Project
     */
    public function setPresentationMedia(?string $presentationMedia): Project
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
     * @return PersistentCollection|null
     */
    public function getProjectTags(): ?PersistentCollection
    {
        return $this->projectTags;
    }

    /**
     * @param PersistentCollection $projectTags
     * @return Project
     */
    public function setProjectTags(PersistentCollection $projectTags): Project
    {
        $this->projectTags = $projectTags;
        return $this;
    }

    /**
     * @param mixed $projectTag
     */
    public function addProjectTag($projectTag): void
    {
        $this->projectTags->add($projectTag);
        $projectTag->setProject($this);
    }

    /**
     * @param mixed $projectTag
     */
    public function removeProjectTag($projectTag): void
    {
        $this->projectTags->removeElement($projectTag);
        // uncomment if you want to update other side
        //$projectTag->setProject(null);
    }


    /**
     * @return string
     */
    public function getCardImage(): ?string
    {
        return $this->cardImage;
    }

    /**
     * @param string|null $cardImage
     * @return Project
     */
    public function setCardImage(?string $cardImage): Project
    {
        $this->cardImage = $cardImage;
        return $this;
    }

    /**
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @param City $city
     * @return Project
     */
    public function setCity(City $city): Project
    {
        $this->city = $city;
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
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return Project
     */
    public function setLink(string $link): Project
    {
        $this->link = strtolower($link);
        return $this;
    }

    /**
     * @return Perk[]|PersistentCollection|null
     */
    public function getPerks(): ?PersistentCollection
    {
        return $this->perks;
    }

    /**
     * @param PersistentCollection $perks
     * @return Project
     */
    public function setPerks(PersistentCollection $perks): Project
    {
        $this->perks = $perks;
        return $this;
    }

    /**
     * @param mixed $perk
     */
    public function addPerk($perk): void
    {
        $this->perks->add($perk);
        $perk->setProject($this);
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return Project
     */
    public function setCategory(Category $category): Project
    {
        $this->category = $category;
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
