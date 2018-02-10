<?php

namespace App\Dto;

use JMS\Serializer\Annotation as JMS;

class UpdatePerkInfoRequestDto
{
    /**
     * @var integer
     * @JMS\Type("integer")
     */
    public $perkId;

    /**
     * @var string|null
     * @JMS\Type("string")
     */
    public $title;

    /**
     * @var integer|null
     * @JMS\Type("integer")
     */
    public $amount;

    /**
     * @var string|null
     * @JMS\Type("string")
     */
    public $description;

    /**
     * @var integer|null
     * @JMS\Type("integer")
     */
    public $diffQuantity;

    /**
     * @var string|null
     * @JMS\Type("string")
     */
    public $imagePath;

    /**
     * @var boolean|null
     * @JMS\Type("boolean")
     */
    public $unsetImagePath;

    /**
     * @var boolean|null
     * @JMS\Type("boolean")
     */
    public $unsetQuantity;

    /**
     * @return int
     */
    public function getPerkId(): int
    {
        return $this->perkId;
    }

    /**
     * @param int $perkId
     * @return UpdatePerkInfoRequestDto
     */
    public function setPerkId(int $perkId): UpdatePerkInfoRequestDto
    {
        $this->perkId = $perkId;
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
     * @return UpdatePerkInfoRequestDto
     */
    public function setTitle(?string $title): UpdatePerkInfoRequestDto
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * @param int|null $amount
     * @return UpdatePerkInfoRequestDto
     */
    public function setAmount(?int $amount): UpdatePerkInfoRequestDto
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     * @return UpdatePerkInfoRequestDto
     */
    public function setDescription(?string $description): UpdatePerkInfoRequestDto
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDiffQuantity(): ?int
    {
        return $this->diffQuantity;
    }

    /**
     * @param int|null $diffQuantity
     * @return UpdatePerkInfoRequestDto
     */
    public function setDiffQuantity(?int $diffQuantity): UpdatePerkInfoRequestDto
    {
        $this->diffQuantity = $diffQuantity;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    /**
     * @param null|string $imagePath
     * @return UpdatePerkInfoRequestDto
     */
    public function setImagePath(?string $imagePath): UpdatePerkInfoRequestDto
    {
        $this->imagePath = $imagePath;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getUnsetImagePath(): ?bool
    {
        return $this->unsetImagePath;
    }

    /**
     * @param bool|null $unsetImagePath
     * @return UpdatePerkInfoRequestDto
     */
    public function setUnsetImagePath(?bool $unsetImagePath): UpdatePerkInfoRequestDto
    {
        $this->unsetImagePath = $unsetImagePath;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getUnsetQuantity(): ?bool
    {
        return $this->unsetQuantity;
    }

    /**
     * @param bool|null $unsetQuantity
     * @return UpdatePerkInfoRequestDto
     */
    public function setUnsetQuantity(?bool $unsetQuantity): UpdatePerkInfoRequestDto
    {
        $this->unsetQuantity = $unsetQuantity;
        return $this;
    }
}
