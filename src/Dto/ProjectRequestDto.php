<?php

namespace App\Dto;

use JMS\Serializer\Annotation as JMS;

class ProjectRequestDto
{
    /**
     * @var integer
     * @JMS\Type("integer")
     */
    public $projectId;

    /**
     * @var string|null
     * @JMS\Type("string")
     */
    public $title;

    /**
     * @var string|null
     * @JMS\Type("string")
     */
    public $shortDescription;

    /**
     * @var integer|null
     * @JMS\Type("integer")
     */
    public $pledgedAmount;

    /**
     * @var integer|null
     * @JMS\Type("integer")
     */
    public $totalAmount;

    /**
     * @var string|null
     * @JMS\Type("string")
     */
    public $presentationMedia;

    /**
     * @var string|null
     * @JMS\Type("string")
     */
    public $content;

    /**
     * @var integer|null
     * @JMS\Type("integer")
     */
    public $cityId;

    /**
     * @var string|null
     * @JMS\Type("string")
     */
    public $cardImage;

    /**
     * @var string|null
     * @JMS\Type("string")
     */
    public $expirationDate;

    /**
     * @var string|null
     * @JMS\Type("string")
     */
    public $link;

    /**
     * @var bool
     * @JMS\Type("boolean")
     */
    public $unsetTotalAmount = false;

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     * @return ProjectRequestDto
     */
    public function setProjectId(int $projectId): ProjectRequestDto
    {
        $this->projectId = $projectId;
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
     * @return ProjectRequestDto
     */
    public function setTitle(string $title): ProjectRequestDto
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
     * @return ProjectRequestDto
     */
    public function setShortDescription(string $shortDescription): ProjectRequestDto
    {
        $this->shortDescription = $shortDescription;
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
     * @return ProjectRequestDto
     */
    public function setPledgedAmount(int $pledgedAmount): ProjectRequestDto
    {
        $this->pledgedAmount = $pledgedAmount;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTotalAmount(): ?int
    {
        return $this->totalAmount;
    }

    /**
     * @param int|null $totalAmount
     * @return ProjectRequestDto
     */
    public function setTotalAmount(?int $totalAmount): ProjectRequestDto
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPresentationMedia(): ?string
    {
        return $this->presentationMedia;
    }

    /**
     * @param null|string $presentationMedia
     * @return ProjectRequestDto
     */
    public function setPresentationMedia(?string $presentationMedia): ProjectRequestDto
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
     * @return ProjectRequestDto
     */
    public function setContent(string $content): ProjectRequestDto
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->cityId;
    }

    /**
     * @param int $cityId
     * @return ProjectRequestDto
     */
    public function setCityId(int $cityId): ProjectRequestDto
    {
        $this->cityId = $cityId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCardImage(): ?string
    {
        return $this->cardImage;
    }

    /**
     * @param null|string $cardImage
     * @return ProjectRequestDto
     */
    public function setCardImage(?string $cardImage): ProjectRequestDto
    {
        $this->cardImage = $cardImage;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpirationDate(): string
    {
        return $this->expirationDate;
    }

    /**
     * @param string $expirationDate
     * @return ProjectRequestDto
     */
    public function setExpirationDate(string $expirationDate): ProjectRequestDto
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
     * @return ProjectRequestDto
     */
    public function setLink(string $link): ProjectRequestDto
    {
        $this->link = $link;
        return $this;
    }
}
