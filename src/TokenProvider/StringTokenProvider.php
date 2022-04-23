<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\TokenProvider;

class StringTokenProvider implements TokenProviderInterface
{
    public function __construct(
        private string $token,
    ) {
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
