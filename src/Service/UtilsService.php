<?php

namespace App\Service;

use App\Entity\Perk;

class UtilsService
{
    /**
     * Generates a random token that can be used in anytime, anywhere
     *
     * @param string $optionalString
     * @return string
     */
    public static function generateRandomToken(string $optionalString = ''): string
    {
        try {
            $token = md5(uniqid(random_bytes(5) . $optionalString, true));
        } catch (\Exception $e) {
            $token = md5(uniqid($optionalString, true));
        }

        return $token;
    }

    /**
     * @param Perk $perk
     * @return array
     */
    public static function formatPerkForResponse(Perk $perk): array
    {
        return [
            'id' => $perk->getId(),
            'title' => $perk->getTitle(),
            'amount' => $perk->getAmount(),
            'description' => $perk->getDescription(),
            'available_quantity' => $perk->getAvailableQuantity(),
            'total_quantity' => $perk->getTotalQuantity()
        ];
    }
}
