<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 08.02.2018
 * Time: 21:20
 */

namespace App;


use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;

class CacheKernel extends HttpCache
{
    protected function getOptions(): array
    {
        return [
            'default_ttl' => 3600,
        ];
    }
}
