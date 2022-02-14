<?php

declare(strict_types=1);

namespace Ushakovme\Remonline;

use DateTime;

trait DateTrait
{
    protected static function getDate(array $data, string $key): ?DateTime
    {
        if (empty($data[$key])) {
            return null;
        }

        $timestamp = (int) ($data[$key] / 1000);
        return (new DateTime())->setTimestamp($timestamp);
    }
}
