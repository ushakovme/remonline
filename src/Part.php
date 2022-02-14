<?php

declare(strict_types=1);

namespace Ushakovme\Remonline;

class Part
{
    private int $id;
    private int $engineer_id;
    private string $title;
    private float $cost;
    private float $price;
    private float $discount_value;
    private float $amount;
    private float $warranty;
    private int $warranty_period;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEngineerId(): int
    {
        return $this->engineer_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscountValue(): float
    {
        return $this->discount_value;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getWarranty(): float
    {
        return $this->warranty;
    }

    public function getWarrantyPeriod(): int
    {
        return $this->warranty_period;
    }

    public static function fromArray(array $data): self
    {
        $item = new self();
        $item->id = $data['id'];
        $item->engineer_id = $data['engineer_id'];
        $item->title = $data['title'];
        $item->cost = $data['cost'];
        $item->price = $data['price'];
        $item->discount_value = $data['discount_value'];
        $item->amount = $data['amount'];
        $item->warranty = $data['warranty'];
        $item->warranty_period = $data['warranty_period'];

        return $item;
    }
}
