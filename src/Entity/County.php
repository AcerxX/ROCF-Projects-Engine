<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountyRepository")
 * @ORM\Table(name="counties")
 */
class County
{
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
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private $seoName;

    /**
     * @var City[]
     * @ORM\OneToMany(targetEntity="City", mappedBy="county")
     */
    private $cities = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return County
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return County
     */
    public function setName(string $name): County
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeoName(): string
    {
        return $this->seoName;
    }

    /**
     * @param string $seoName
     * @return County
     */
    public function setSeoName(string $seoName): County
    {
        $this->seoName = $seoName;
        return $this;
    }

    /**
     * @return City[]
     */
    public function getCities(): array
    {
        return $this->cities;
    }

    /**
     * @param City[] $cities
     * @return County
     */
    public function setCities(array $cities): County
    {
        $this->cities = $cities;
        return $this;
    }

    /**
     * @param City $city
     */
    public function addCity(City $city): void
    {
        $this->cities[] = $city;
    }

    /**
     * @param City $city
     */
    public function removeCity(City $city): void
    {
        if (false !== $key = array_search($city, $this->cities, true)) {
            array_splice($this->cities, $key, 1);
        }
    }

}
