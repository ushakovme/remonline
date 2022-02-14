<?php

declare(strict_types=1);

namespace Ushakovme\Remonline;

use Psr\Http\Message\RequestInterface as PSRRequestInterface;
use RuntimeException;
use Ushakovme\Remonline\Requests\ClientsRequest;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;
use Ushakovme\Remonline\Requests\OrdersRequest;
use Ushakovme\Remonline\Requests\RequestInterface;
use Ushakovme\Remonline\Response\ClientsResponse;
use Ushakovme\Remonline\Response\OrdersResponse;

class RemonlineClient
{
    public function __construct(private ClientInterface $client, private string $token)
    {
    }

    public function clients(ClientsRequest $clientsRequest): ClientsResponse
    {
        $request = $this->makeGetRequest($clientsRequest, 'clients');
        $response = $this->sendRequest($request);
        return ClientsResponse::fromArray($response);
    }

    public function orders(OrdersRequest $ordersRequest): OrdersResponse
    {
        $request = $this->makeGetRequest($ordersRequest, 'order');
        $response = $this->sendRequest($request);
        return OrdersResponse::fromArray($response);
    }

    private function sendRequest(PSRRequestInterface $request): array
    {
        $response = $this->client->sendRequest($request);
        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException('Request error: ' . $data['message'] ?? '');
        }
        return $data;
    }

    private function makeGetRequest(RequestInterface $request, string $path): PSRRequestInterface
    {
        $data = $request->toArray();
        $data['token'] = $this->token;

        $url = $path . '/?' . urldecode(http_build_query($data));
        $url = preg_replace('/\[\d]/', '[]', $url);

        return new Request(
            'GET', $url
        );
    }
}
