<?php

declare(strict_types=1);

namespace Ushakovme\Remonline;

use DateTime;

class Order
{
    use DateTrait;

    private int $id;
    private string $brand;
    private string $model;
    private float $price;
    private float $payed;
    private string $resume;
    private bool $urgent;
    private string $serial;
    private Client $client;
    private AdCampaign $ad_campaign;
    private Status $status;
    private ?DateTime $done_at;
    private bool $overdue;
    private int $engineer_id;
    private int $manager_id;
    private int $branch_id;
    private string $appearance;
    private int $created_by_id;
    private OrderType $order_type;
    /* @var Part[] $parts */
    private array $parts;
    /* @var Operation[] $parts */
    private array $operations;
    /* @var Tax[] $taxes */
    private array $taxes;
    /* @var Attachment[] */
    private array $attachments;
    private DateTime $created_at;
    private ?DateTime $scheduled_for;
    private ?DateTime $closed_at;
    private ?DateTime $modified_at;
    private string $packagelist;
    private string $kindof_good;
    private string $malfunction;
    private string $id_label;
    private int $closed_by_id;
    private CustomFields $custom_fields;
    private ?DateTime $warranty_date;
    private string $manager_notes;
    private float $estimated_cost;
    private string $engineer_notes;
    private bool $warranty_granted;
    private ?DateTime $estimated_done_at;

    public static function fromArray(array $data): Order
    {
        $order = new self();
        $order->id = $data['id'];
        $order->brand = $data['brand'] ?? '';
        $order->model = $data['model'] ?? '';
        $order->price = $data['price'] ?? 0;
        $order->payed = $data['payed'] ?? 0;
        $order->resume = $data['resume'] ?? '';
        $order->urgent = $data['urgent'] ?? '';
        $order->serial = $data['serial'] ?? '';
        $order->client = Client::fromArray($data['client']);
        $order->ad_campaign = AdCampaign::fromArray($data['ad_campaign']);
        $order->status = Status::fromArray($data['status']);
        $order->done_at = self::getDate($data, 'done_at');
        $order->overdue = $data['overdue'] ?? false;
        $order->engineer_id = $data['engineer_id'] ?? 0;
        $order->manager_id = $data['manager_id'] ?? 0;
        $order->branch_id = $data['branch_id'] ?? 0;
        $order->appearance = $data['appearance'] ?? '';
        $order->created_by_id = $data['created_by_id'] ?? 0;
        $order->order_type = OrderType::fromArray($data['order_type']);
        $order->parts = array_map(static function (array $data): Part {
            return Part::fromArray($data);
        }, $data['parts'] ?? []);
        $order->operations = array_map(static function (array $data): Operation {
            return Operation::fromArray($data);
        }, $data['operations'] ?? []);
        $order->taxes = array_map(static function (array $data): Tax {
            return Tax::fromArray($data);
        }, $data['taxes'] ?? []);
        $order->attachments = array_map(static function (array $data): Attachment {
            return Attachment::fromArray($data);
        }, $data['attachments'] ?? []);
        $order->created_at = self::getDate($data, 'created_at');
        $order->scheduled_for = self::getDate($data, 'scheduled_for');
        $order->closed_at = self::getDate($data, 'closed_at');
        $order->modified_at = self::getDate($data, 'modified_at');
        $order->packagelist = $data['packagelist'];
        $order->kindof_good = $data['kindof_good'] ?? '';
        $order->malfunction = $data['malfunction'] ?? '';
        $order->id_label = $data['id_label'] ?? 0;
        $order->closed_by_id = $data['closed_by_id'] ?? 0;
        $order->custom_fields = CustomFields::fromArray($data['custom_fields'] ?? []);
        $order->warranty_date = self::getDate($data, 'warranty_date');
        $order->manager_notes = $data['manager_notes'] ?? '';
        $order->estimated_cost = empty($data['estimated_cost']) ? 0 : (float) $data['estimated_cost'];
        $order->engineer_notes = $data['engineer_notes'] ?? '';
        $order->warranty_granted = $data['warranty_granted'] ?? false;
        $order->estimated_done_at = self::getDate($data, 'estimated_done_at');
        $order->custom_fields = CustomFields::fromArray($data['custom_fields'] ?? []);

        return $order;
    }

    public function getScheduledFor(): ?DateTime
    {
        return $this->scheduled_for;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getPayed(): float
    {
        return $this->payed;
    }

    public function getResume(): string
    {
        return $this->resume;
    }

    public function isUrgent(): bool
    {
        return $this->urgent;
    }

    public function getSerial(): string
    {
        return $this->serial;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getAdCampaign(): AdCampaign
    {
        return $this->ad_campaign;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getDoneAt(): ?DateTime
    {
        return $this->done_at;
    }

    public function isOverdue(): bool
    {
        return $this->overdue;
    }

    public function getEngineerId(): int
    {
        return $this->engineer_id;
    }

    public function getManagerId(): int
    {
        return $this->manager_id;
    }

    public function getBranchId(): int
    {
        return $this->branch_id;
    }

    public function getAppearance(): string
    {
        return $this->appearance;
    }

    public function getCreatedById(): int
    {
        return $this->created_by_id;
    }

    public function getOrderType(): OrderType
    {
        return $this->order_type;
    }

    /**
     * @return Part[]
     */
    public function getParts(): array
    {
        return $this->parts;
    }

    /**
     * @return Operation[]
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

    /**
     * @return Tax[]
     */
    public function getTaxes(): array
    {
        return $this->taxes;
    }

    /**
     * @return Attachment[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function getClosedAt(): ?DateTime
    {
        return $this->closed_at;
    }

    public function getModifiedAt(): ?DateTime
    {
        return $this->modified_at;
    }

    public function getPackagelist(): string
    {
        return $this->packagelist;
    }

    public function getKindofGood(): string
    {
        return $this->kindof_good;
    }

    public function getMalfunction(): string
    {
        return $this->malfunction;
    }

    public function getIdLabel(): string
    {
        return $this->id_label;
    }

    public function getClosedById(): int
    {
        return $this->closed_by_id;
    }

    public function getCustomFields(): CustomFields
    {
        return $this->custom_fields;
    }

    public function getWarrantyDate(): ?DateTime
    {
        return $this->warranty_date;
    }

    public function getManagerNotes(): string
    {
        return $this->manager_notes;
    }

    public function getEstimatedCost(): float
    {
        return $this->estimated_cost;
    }

    public function getEngineerNotes(): string
    {
        return $this->engineer_notes;
    }

    public function isWarrantyGranted(): bool
    {
        return $this->warranty_granted;
    }

    public function getEstimatedDoneAt(): ?DateTime
    {
        return $this->estimated_done_at;
    }
}
