<?php

namespace App\Dto;

use JMS\Serializer\Annotation as JMS;

class ProjectsListingRequestDto
{
    /**
     * @var integer|null
     * @JMS\Type("integer")
     */
    private $userId;

    /**
     * @var integer|null
     * @JMS\Type("integer")
     */
    private $categoryId;

    /**
     * @var integer|null
     * @JMS\Type("integer")
     */
    private $location;

    /**
     * @var string|null
     * @JMS\Type("string")
     */
    private $searchedText;

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     * @return ProjectsListingRequestDto
     */
    public function setUserId(?int $userId): ProjectsListingRequestDto
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int|null $categoryId
     * @return ProjectsListingRequestDto
     */
    public function setCategoryId(?int $categoryId): ProjectsListingRequestDto
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLocation(): ?int
    {
        return $this->location;
    }

    /**
     * @param int|null $location
     * @return ProjectsListingRequestDto
     */
    public function setLocation(?int $location): ProjectsListingRequestDto
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSearchedText(): ?string
    {
        return $this->searchedText;
    }

    /**
     * @param null|string $searchedText
     * @return ProjectsListingRequestDto
     */
    public function setSearchedText(?string $searchedText): ProjectsListingRequestDto
    {
        $this->searchedText = $searchedText;
        return $this;
    }
}
