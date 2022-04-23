<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\TokenProvider;

interface TokenProviderInterface
{
    public function getToken(): string;
}
