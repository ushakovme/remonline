<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\Response;

final class CustomFields
{
    private array $data;

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
}
