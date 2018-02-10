<?php

namespace App\Dto;

use JMS\Serializer\Annotation as JMS;

class UpdateProjectInfoRequestDto
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
     * @var bool|null
     * @JMS\Type("boolean")
     */
    public $unsetTotalAmount = false;

    /**
     * @var bool|null
     * @JMS\Type("boolean")
     */
    public $unsetPresentationMedia = false;

    /**
     * @var bool|null
     * @JMS\Type("boolean")
     */
    public $unsetCardImage = false;

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     * @return UpdateProjectInfoRequestDto
     */
    public function setProjectId(int $projectId): UpdateProjectInfoRequestDto
    {
        $this->projectId = $projectId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     * @return UpdateProjectInfoRequestDto
     */
    public function setTitle(?string $title): UpdateProjectInfoRequestDto
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    /**
     * @param null|string $shortDescription
     * @return UpdateProjectInfoRequestDto
     */
    public function setShortDescription(?string $shortDescription): UpdateProjectInfoRequestDto
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPledgedAmount(): ?int
    {
        return $this->pledgedAmount;
    }

    /**
     * @param int|null $pledgedAmount
     * @return UpdateProjectInfoRequestDto
     */
    public function setPledgedAmount(?int $pledgedAmount): UpdateProjectInfoRequestDto
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
     * @return UpdateProjectInfoRequestDto
     */
    public function setTotalAmount(?int $totalAmount): UpdateProjectInfoRequestDto
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
     * @return UpdateProjectInfoRequestDto
     */
    public function setPresentationMedia(?string $presentationMedia): UpdateProjectInfoRequestDto
    {
        $this->presentationMedia = $presentationMedia;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param null|string $content
     * @return UpdateProjectInfoRequestDto
     */
    public function setContent(?string $content): UpdateProjectInfoRequestDto
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCityId(): ?int
    {
        return $this->cityId;
    }

    /**
     * @param int|null $cityId
     * @return UpdateProjectInfoRequestDto
     */
    public function setCityId(?int $cityId): UpdateProjectInfoRequestDto
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
     * @return UpdateProjectInfoRequestDto
     */
    public function setCardImage(?string $cardImage): UpdateProjectInfoRequestDto
    {
        $this->cardImage = $cardImage;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getExpirationDate(): ?string
    {
        return $this->expirationDate;
    }

    /**
     * @param null|string $expirationDate
     * @return UpdateProjectInfoRequestDto
     */
    public function setExpirationDate(?string $expirationDate): UpdateProjectInfoRequestDto
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param null|string $link
     * @return UpdateProjectInfoRequestDto
     */
    public function setLink(?string $link): UpdateProjectInfoRequestDto
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getUnsetTotalAmount(): ?bool
    {
        return $this->unsetTotalAmount;
    }

    /**
     * @param bool|null $unsetTotalAmount
     * @return UpdateProjectInfoRequestDto
     */
    public function setUnsetTotalAmount(?bool $unsetTotalAmount): UpdateProjectInfoRequestDto
    {
        $this->unsetTotalAmount = $unsetTotalAmount;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getUnsetPresentationMedia(): ?bool
    {
        return $this->unsetPresentationMedia;
    }

    /**
     * @param bool|null $unsetPresentationMedia
     * @return UpdateProjectInfoRequestDto
     */
    public function setUnsetPresentationMedia(?bool $unsetPresentationMedia): UpdateProjectInfoRequestDto
    {
        $this->unsetPresentationMedia = $unsetPresentationMedia;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getUnsetCardImage(): ?bool
    {
        return $this->unsetCardImage;
    }

    /**
     * @param bool|null $unsetCardImage
     * @return UpdateProjectInfoRequestDto
     */
    public function setUnsetCardImage(?bool $unsetCardImage): UpdateProjectInfoRequestDto
    {
        $this->unsetCardImage = $unsetCardImage;
        return $this;
    }
}
