<?php

declare(strict_types=1);

namespace Ushakovme\Remonline;

use DomainException;
use Exception;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use RuntimeException;

final class TokenClient
{
    public function __construct(private ClientInterface $client, private string $apiKey)
    {
    }

    /**
     * @throws ClientExceptionInterface|JsonException|DomainException
     */
    public function getToken(): string
    {
        $request = new Request(
            'POST', 'token/new', [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ], http_build_query(['api_key' => $this->apiKey])
        );

        $response = $this->client->sendRequest($request);
        $body = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        if ($response->getStatusCode() !== 200) {
            $errorMessage = $body['message'];
            throw new RuntimeException('Request error. ' . $errorMessage);
        }

        $token = $body['token'] ?? null;
        if (empty($token)) {
            throw new DomainException('Error parsing token');
        }

        return $token;
    }
}
