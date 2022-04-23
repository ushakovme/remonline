<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\TokenProvider;

class CallbackTokenProvider implements TokenProviderInterface
{
    public function __construct(private \Closure $callback)
    {

    }

    public function getToken(): string
    {
        return $this->callback->call($this);
    }

}
