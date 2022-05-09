<?php

declare(strict_types=1);

namespace Ushakovme\Remonline;

use DateTime;
use Exception;
use InvalidArgumentException;


final class Client
{
    use DateTrait;

    private int $id;
    private string $name;
    /**
     * @var string[]
     */
    private array $phone = [];
    private string $email = '';
    private string $notes = '';
    private string $address = '';
    private bool $supplier = false;
    private bool $juridical = false;
    private bool $conflicted = false;
    private ?DateTime $modified_at;
    private ?DateTime $created_at;
    private string $discount_code = '';
    private float $discount_goods = 0;
    private float $discount_services = 0;
    private float $discount_materials = 0;
    private int $discount_goods_margin_id = 0;
    private int $discount_materials_margin_id = 0;
    private ?CustomFields $custom_fields = null;
    private ?AdCampaign $ad_campaign = null;

    public function toArray(): array
    {
        $data = [];
        if (!empty($this->id)) {
            $data['id'] = $this->id;
        }
        if (!empty($this->name)) {
            $data['name'] = $this->name;
        }
        if (!empty($this->phone)) {
            $data['phone'] = $this->phone;
        }
        if (!empty($this->email)) {
            $data['email'] = $this->email;
        }
        if (!empty($this->email)) {
            $data['email'] = $this->email;
        }
        if (!empty($this->email)) {
            $data['email'] = $this->email;
        }
        if (!empty($this->email)) {
            $data['email'] = $this->email;
        }
        if (!empty($this->notes)) {
            $data['notes'] = $this->notes;
        }
        if (!empty($this->address)) {
            $data['address'] = $this->address;
        }
        if (!empty($this->supplier)) {
            $data['supplier'] = $this->supplier;
        }
        if (!empty($this->juridical)) {
            $data['juridical'] = $this->juridical;
        }
        if (!empty($this->conflicted)) {
            $data['conflicted'] = $this->conflicted;
        }
        if (!empty($this->discount_code)) {
            $data['discount_code'] = $this->discount_code;
        }
        if (!empty($this->discount_services)) {
            $data['discount_services'] = $this->discount_services;
        }
        if (!empty($this->discount_materials)) {
            $data['discount_materials'] = $this->discount_materials;
        }
        if (!empty($this->discount_goods_margin_id)) {
            $data['discount_goods_margin_id'] = $this->discount_goods_margin_id;
        }
        if (!empty($this->discount_materials_margin_id)) {
            $data['discount_materials_margin_id'] = $this->discount_materials_margin_id;
        }
        if (!empty($this->custom_fields)) {
            $data['custom_fields'] = $this->custom_fields->toArray();
        }

        return $data;
    }

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
        $client->modified_at = self::getDate($data, 'modified_at');
        $client->created_at = self::getDate($data, 'created_at');
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
        return $this->custom_fields ?? new CustomFields();
    }

    public function getAdCampaign(): ?AdCampaign
    {
        return $this->ad_campaign;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string[] $phones
     */
    public function setPhone(array $phones): void
    {
        foreach ($phones as $phone) {
            if (!is_string($phone)) {
                throw new InvalidArgumentException('phone must be string');
            }
        }
        $this->phone = $phones;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function setSupplier(bool $supplier): void
    {
        $this->supplier = $supplier;
    }

    public function setJuridical(bool $juridical): void
    {
        $this->juridical = $juridical;
    }

    public function setConflicted(bool $conflicted): void
    {
        $this->conflicted = $conflicted;
    }

    public function setModifiedAt(?DateTime $modified_at): void
    {
        $this->modified_at = $modified_at;
    }

    public function setCreatedAt(?DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function setDiscountCode(string $discount_code): void
    {
        $this->discount_code = $discount_code;
    }

    public function setDiscountGoods(float $discount_goods): void
    {
        $this->discount_goods = $discount_goods;
    }

    public function setDiscountServices(float $discount_services): void
    {
        $this->discount_services = $discount_services;
    }

    public function setDiscountMaterials(float $discount_materials): void
    {
        $this->discount_materials = $discount_materials;
    }

    public function setDiscountGoodsMarginId(int $discount_goods_margin_id): void
    {
        $this->discount_goods_margin_id = $discount_goods_margin_id;
    }

    public function setDiscountMaterialsMarginId(int $discount_materials_margin_id): void
    {
        $this->discount_materials_margin_id = $discount_materials_margin_id;
    }

    public function setCustomFields(CustomFields $custom_fields): void
    {
        $this->custom_fields = $custom_fields;
    }

    public function setAdCampaign(?AdCampaign $ad_campaign): void
    {
        $this->ad_campaign = $ad_campaign;
    }
}
