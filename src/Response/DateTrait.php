<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\Response;

use DateTime;

trait DateTrait
{
    protected static function getDate(array $data, string $key): ?DateTime
    {
        $timestamp = (int) ($data[$key] / 1000);
        return empty($data[$key]) ? null : (new DateTime())->setTimestamp($timestamp);
    }
}
