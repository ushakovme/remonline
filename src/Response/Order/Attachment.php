<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\Response\Order;

use DateTime;

class Attachment
{
    private int $created_by_id;
    private DateTime $created_at;
    private string $url;
    private string $filename;

    public static function fromArray(array $data): self
    {
        $item = new self();
        $item->created_at = (new DateTime())->setTimestamp($data['created_at']);
        $item->created_by_id = $data['created_by_id'];
        $item->url = $data['url'];
        $item->filename = $data['filename'];

        return $item;
    }

    public function getCreatedById(): int
    {
        return $this->created_by_id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

}
