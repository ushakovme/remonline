<?php

declare(strict_types=1);

namespace Ushakovme\Remonline;

class OrderType
{
    private int $id;
    private string $title;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public static function fromArray(array $data): self
    {
        $type = new self();
        $type->id = $data['id'];
        $type->title = $data['title'] ?? '';

        return $type;
    }
}
