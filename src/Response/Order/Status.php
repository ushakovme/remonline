<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\Response\Order;

final class Status
{
    private int $id;
    private string $name;
    private int $group;
    private string $color;

    public static function fromArray(array $data): self
    {
        $item = new self();
        $item->id = $data['id'];
        $item->name = $data['name'];
        $item->group = $data['group'];
        $item->color = $data['color'];

        return $item;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGroup(): int
    {
        return $this->group;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}
