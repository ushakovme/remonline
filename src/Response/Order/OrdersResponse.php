<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\Response\Order;

final class OrdersResponse
{
    private int $count;
    /**
     * @var Order[]
     */
    private array $orders;
    private int $page;


    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return Order[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public static function fromArray(array $data): self
    {
        $response = new self();
        $response->count = $data['count'];
        $response->page = $data['page'];
        $response->orders = array_map(static function (array $item): Order {
            return Order::fromArray($item);
        }, $data['data']);

        return $response;
    }
}
