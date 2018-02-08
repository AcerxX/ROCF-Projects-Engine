<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\Table(name="categories")
 */
class Category
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
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private $nameRo;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private $nameEn;

    /**
     * @var string
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
     * @return Category
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNameRo(): string
    {
        return $this->nameRo;
    }

    /**
     * @param string $nameRo
     * @return Category
     */
    public function setNameRo(string $nameRo): Category
    {
        $this->nameRo = $nameRo;
        return $this;
    }

    /**
     * @return string
     */
    public function getNameEn(): string
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEn
     * @return Category
     */
    public function setNameEn(string $nameEn): Category
    {
        $this->nameEn = $nameEn;
        return $this;
    }

    /**
     * @return string
     */
    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    /**
     * @param string $imagePath
     * @return Category
     */
    public function setImagePath(string $imagePath): Category
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
     * @return Category
     */
    public function setStatus(int $status): Category
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
     * @return Category
     */
    public function setCreated(\DateTime $created): Category
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
     * @return Category
     */
    public function setModified(\DateTime $modified): Category
    {
        $this->modified = $modified;
        return $this;
    }
}
