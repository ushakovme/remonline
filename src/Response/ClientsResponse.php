<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\Response;


final class ClientsResponse
{
    private int $count;
    /**
     * @var Client[]
     */
    private array $clients;

    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return Client[]
     */
    public function getClients(): array
    {
        return $this->clients;
    }

    public static function fromArray(array $data): self
    {
        $response = new self();
        $response->count = $data['count'];
        $response->clients = array_map(static function (array $item): Client {
            return Client::fromArray($item);
        }, $data['data']);

        return $response;
    }
}
