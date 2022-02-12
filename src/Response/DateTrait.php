<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\Response;

use DateTime;

trait DateTrait
{
    protected static function getDate(array $data, string $key): ?DateTime
    {
        return empty($data[$key]) ? null : (new DateTime())->setTimestamp($data[$key]);
    }
}
