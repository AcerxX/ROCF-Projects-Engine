<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 * @ORM\Table(name="cities")
 */
class City
{
    public const CITY_ID_ALL = 3185;

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
     * @var County
     * @ORM\ManyToOne(targetEntity="County", inversedBy="cities")
     * @ORM\JoinColumn(name="county_id", referencedColumnName="id")
     */
    private $county;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return City
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
     * @return City
     */
    public function setName(string $name): City
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
     * @return City
     */
    public function setSeoName(string $seoName): City
    {
        $this->seoName = $seoName;
        return $this;
    }

    /**
     * @return County
     */
    public function getCounty(): County
    {
        return $this->county;
    }

    /**
     * @param County $county
     * @return City
     */
    public function setCounty(County $county): City
    {
        $this->county = $county;
        return $this;
    }
}
