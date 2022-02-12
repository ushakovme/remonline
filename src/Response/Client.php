<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\Response;

use Ushakovme\Remonline\Response\AdCampaign;
use DateTime;


final class Client
{
    use DateTrait;

    private int $id;
    private string $name;
    private array $phone;
    private string $email;
    private string $notes;
    private string $address;
    private bool $supplier;
    private bool $juridical;
    private bool $conflicted;
    private ?DateTime $modified_at;
    private ?DateTime $created_at;
    private string $discount_code;
    private float $discount_goods;
    private float $discount_services;
    private float $discount_materials;
    private int $discount_goods_margin_id;
    private int $discount_materials_margin_id;
    private CustomFields $custom_fields;
    private ?AdCampaign $ad_campaign;

    public static function fromArray(array $data): Client
    {
        $client = new self();
        $client->id = $data['id'];
        $client->name = $data['name'] ?? '';
        $client->phone = $data['phone'] ?? [];
        $client->email = $data['email'] ?? '';
        $client->notes = $data['notes'] ?? '';
        $client->address = $data['address'] ?? '';
        $client->supplier = $data['supplier'] ?? false;
        $client->juridical = $data['juridical'] ?? false;
        $client->conflicted = $data['conflicted'] ?? false;
        $client->modified_at = static::getDate($data, 'modified_at');
        $client->created_at = static::getDate($data, 'created_at');
        $client->discount_code = $data['discount_code'] ?? '';
        $client->discount_goods = $data['discount_goods'] ?? 0;
        $client->discount_services = $data['discount_services'] ?? 0;
        $client->discount_materials = $data['discount_materials'] ?? 0;
        $client->discount_goods_margin_id = $data['discount_goods_margin_id'] ?? 0;
        $client->discount_materials_margin_id = $data['discount_materials_margin_id'] ?? 0;
        $client->ad_campaign = $data['ad_campaign'] ? AdCampaign::fromArray($data['ad_campaign']) : null;
        $client->custom_fields = CustomFields::fromArray($data['custom_fields'] ?? []);

        return $client;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): array
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function isSupplier(): bool
    {
        return $this->supplier;
    }

    public function isJuridical(): bool
    {
        return $this->juridical;
    }

    public function isConflicted(): bool
    {
        return $this->conflicted;
    }

    public function getModifiedAt(): DateTime
    {
        return $this->modified_at;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function getDiscountCode(): string
    {
        return $this->discount_code;
    }

    public function getDiscountGoods(): float
    {
        return $this->discount_goods;
    }

    public function getDiscountServices(): float
    {
        return $this->discount_services;
    }

    public function getDiscountMaterials(): float
    {
        return $this->discount_materials;
    }

    public function getDiscountGoodsMarginId(): int
    {
        return $this->discount_goods_margin_id;
    }

    public function getDiscountMaterialsMarginId(): int
    {
        return $this->discount_materials_margin_id;
    }

    public function getCustomFields(): CustomFields
    {
        return $this->custom_fields;
    }

    public function getAdCampaign(): ?AdCampaign
    {
        return $this->ad_campaign;
    }
}
