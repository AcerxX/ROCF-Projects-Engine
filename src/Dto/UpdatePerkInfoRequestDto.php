<?php

namespace App\Dto;

use JMS\Serializer\Annotation as JMS;

class UpdatePerkInfoRequestDto
{
    /**
     * @var UpdatePerkInfoRequestDataDto[]
     * @JMS\Type("array<App\Dto\UpdatePerkInfoRequestDataDto>")
     */
    private $data = [];

    /**
     * @return UpdatePerkInfoRequestDataDto[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param UpdatePerkInfoRequestDataDto[] $data
     * @return UpdatePerkInfoRequestDto
     */
    public function setData(array $data): UpdatePerkInfoRequestDto
    {
        $this->data = $data;
        return $this;
    }
}
