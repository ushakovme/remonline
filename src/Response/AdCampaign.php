<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\Response;

final class AdCampaign
{
    private int $id;
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function fromArray(array $data): self
    {
        $item = new self();
        $item->id = $data['id'];
        $item->name = $data['name'];

        return $item;
    }
}
