<?php

namespace App\Dto;

use JMS\Serializer\Annotation as JMS;

class PerkRequestDto
{
    /**
     * @var integer
     * @JMS\Type("integer")
     */
    public $projectId;

    /**
     * @var string
     * @JMS\Type("string")
     */
    public $title;

    /**
     * @var integer
     * @JMS\Type("integer")
     */
    public $amount;

    /**
     * @var string
     * @JMS\Type("string")
     */
    public $description;

    /**
     * @var integer|null
     * @JMS\Type("integer")
     */
    public $totalQuantity;

    /**
     * @var string|null
     * @JMS\Type("string")
     */
    public $imagePath = 'https://thumb9.shutterstock.com/display_pic_with_logo/3475769/327209306/stock-photo-perk-word-crowd-from-above-327209306.jpg';

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     * @return PerkRequestDto
     */
    public function setProjectId(int $projectId): PerkRequestDto
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
     * @return PerkRequestDto
     */
    public function setTitle(string $title): PerkRequestDto
    {
        $this->title = $title;
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
     * @return PerkRequestDto
     */
    public function setAmount(int $amount): PerkRequestDto
    {
        $this->amount = $amount;
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
     * @return PerkRequestDto
     */
    public function setDescription(string $description): PerkRequestDto
    {
        $this->description = $description;
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
     * @return PerkRequestDto
     */
    public function setTotalQuantity(int $totalQuantity): PerkRequestDto
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
     * @return PerkRequestDto
     */
    public function setImagePath(string $imagePath): PerkRequestDto
    {
        $this->imagePath = $imagePath;
        return $this;
    }
}
