<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PerkRepository")
 * @ORM\Table(name="perks")
 * @ORM\HasLifecycleCallbacks()
 */
class Perk
{
    public const STATUS_DISABLED = 0;
    public const STATUS_ENABLED = 1;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Project
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="perks")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @var integer|null
     * @ORM\Column(type="integer")
     */
    private $availableQuantity;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $totalQuantity;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=1000)
     */
    private $imagePath;

    /**
     * @var integer
     * @ORM\Column(type="integer", length=1)
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
     * @return Perk
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     * @return Perk
     */
    public function setProject(Project $project): Perk
    {
        $this->project = $project;
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
     * @return Perk
     */
    public function setTitle(string $title): Perk
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Perk
     */
    public function setDescription(string $description): Perk
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return Perk
     */
    public function setAmount(int $amount): Perk
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAvailableQuantity(): ?int
    {
        return $this->availableQuantity;
    }

    /**
     * @param int $availableQuantity
     * @return Perk
     */
    public function setAvailableQuantity(?int $availableQuantity): Perk
    {
        $this->availableQuantity = $availableQuantity;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTotalQuantity(): ?int
    {
        return $this->totalQuantity;
    }

    /**
     * @param int $totalQuantity
     * @return Perk
     */
    public function setTotalQuantity(?int $totalQuantity): Perk
    {
        $this->totalQuantity = $totalQuantity;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    /**
     * @param string $imagePath
     * @return Perk
     */
    public function setImagePath(?string $imagePath): Perk
    {
        $this->imagePath = $imagePath;
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
     * @return Perk
     */
    public function setStatus(int $status): Perk
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
     * @return Perk
     */
    public function setCreated(\DateTime $created): Perk
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
     * @return Perk
     */
    public function setModified(\DateTime $modified): Perk
    {
        $this->modified = $modified;
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
