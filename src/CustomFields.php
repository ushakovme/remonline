<?php

declare(strict_types=1);

namespace Ushakovme\Remonline;

final class CustomFields
{
    private array $data;

    public function toArray(): array
    {
        return $this->data;
    }

    public static function fromArray(array $data): self
    {
        $item = new self();
        $item->data = $data;
        return $item;
    }

    public function get(string $key): ?string
    {
        return $this->data[$key] ?? null;
    }

    public function set(string $key, string $value): void
    {
        $this->data[$key] = $value;
    }
}
