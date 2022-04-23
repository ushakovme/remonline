<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\TokenProvider\Cache;

use Exception;

interface CacheInterface
{
    /**
     * @throws Exception
     */
    public function get(): ?string;

    /**
     * @throws Exception
     */
    public function set(string $value): void;
}
