<?php

declare(strict_types=1);

namespace Ushakovme\Remonline;

final class Tax
{
    private string $code;
    private int $type;
    private int $sum;

    public static function fromArray(array $data): self
    {
        $item = new self();
        $item->code = $data['code'];
        $item->type = $data['type'];
        $item->sum = $data['sum'];

        return $item;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getSum(): int
    {
        return $this->sum;
    }
}
