<?php

declare(strict_types=1);

namespace Ushakovme\Remonline;

use Exception;
use Psr\Http\Message\RequestInterface as PSRRequestInterface;
use RuntimeException;
use Ushakovme\Remonline\Requests\ClientsRequest;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;
use Ushakovme\Remonline\Requests\OrdersRequest;
use Ushakovme\Remonline\Requests\RequestInterface;
use Ushakovme\Remonline\Response\ClientsResponse;
use Ushakovme\Remonline\Response\OrdersResponse;
use Ushakovme\Remonline\TokenProvider\TokenProviderInterface;

class RemonlineClient
{
    public function __construct(
        private ClientInterface $client,
        private TokenProviderInterface $tokenProvider,
    ) {
    }

    public function clients(ClientsRequest $clientsRequest): ClientsResponse
    {
        $request = $this->buildGetRequest('clients', $clientsRequest);
        $response = $this->sendRequest($request);
        return ClientsResponse::fromArray($response);
    }

    public function orders(OrdersRequest $ordersRequest): OrdersResponse
    {
        $request = $this->buildGetRequest('order', $ordersRequest);
        $response = $this->sendRequest($request);
        return OrdersResponse::fromArray($response);
    }

    public function createClient(Client $client): int
    {
        $request = $this->buildPostRequest('clients', $client->toArray());

        $response = $this->sendRequest($request);
        $data = $response['data'] ?? [];

        if (empty($data['id'])) {
            throw new Exception('id is not specified');
        }

        return (int) $data['id'];
    }

    private function sendRequest(PSRRequestInterface $request): array
    {
        $response = $this->client->sendRequest($request);
        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        print_r($data);
        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException('Request error: ' . json_encode($data['message'] ?? '{}'));
        }
        return $data;
    }

    private function buildGetRequest(string $path, RequestInterface $request): PSRRequestInterface
    {
        $data = $request->toArray();
        $url = $this->buildURL($path, $data);

        return new Request(
            'GET', $url
        );
    }

    private function buildPostRequest(string $path, array $data): PSRRequestInterface
    {
        $url = $this->buildURL($path, $data);

        return new Request(
            'POST', $url
        );
    }

    private function buildURL(string $path, array $data): string|array|null
    {
        $data['token'] = $this->tokenProvider->getToken();

        $url = $path . '/?' . urldecode(http_build_query($data));
        return preg_replace('/\[\d]/', '[]', $url);
    }
}
