<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\TokenProvider\Cache;


class InMemoryCache implements CacheInterface
{
    private ?string $token = null;

    public function get(): ?string
    {
        return $this->token;
    }

    public function set(string $value): void
    {
        $this->token = $value;
    }

}
