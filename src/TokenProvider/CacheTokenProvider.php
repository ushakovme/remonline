<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\TokenProvider;

use Ushakovme\Remonline\TokenProvider\Cache\CacheInterface;

class CacheTokenProvider implements TokenProviderInterface
{
    public function __construct(
        private CacheInterface $cache,
        private TokenProviderInterface $parentProvider
    ) {
    }

    public function getToken(): string
    {
        $cachedToken = $this->cache->get();
        if ($cachedToken) {
            return $cachedToken;
        }

        $token = $this->parentProvider->getToken();
        $this->cache->set($token);

        return $token;

    }
}
