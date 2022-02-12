<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\Requests;

final class ClientsRequest implements RequestInterface
{
    private int $page = 1;
    private array $names = [];
    private array $phones = [];
    private array $emails = [];
    private array $addresses = [];
    private array $discount_codes = [];
    private array $modified_at = [];
    private array $created_at = [];
    private array $ad_campaigns = [];
    private ?bool $juridical = null;
    private ?bool $supplier = null;

    public function toArray(): array
    {
        $data = [
            'page' => $this->page
        ];

        if (!empty($this->names)) {
            $data['names'] = $this->names;
        }
        if (!empty($this->phones)) {
            $data['phones'] = $this->phones;
        }
        if (!empty($this->emails)) {
            $data['emails'] = $this->emails;
        }
        if (!empty($this->addresses)) {
            $data['addresses'] = $this->addresses;
        }
        if (!empty($this->discount_codes)) {
            $data['discount_codes'] = $this->discount_codes;
        }
        if (!empty($this->modified_at)) {
            $data['modified_at'] = $this->modified_at;
        }
        if (!empty($this->created_at)) {
            $data['created_at'] = $this->created_at;
        }
        if (!empty($this->ad_campaigns)) {
            $data['ad_campaigns'] = $this->ad_campaigns;
        }
        if (!is_null($this->juridical)) {
            $data['juridical'] = $this->juridical;
        }
        if (!is_null($this->supplier)) {
            $data['supplier'] = $this->supplier;
        }

        return $data;
    }

    public function setNames(array $names): void
    {
        $this->names = $names;
    }

    public function setPhones(array $phones): void
    {
        $this->phones = $phones;
    }

    public function setEmails(array $emails): void
    {
        $this->emails = $emails;
    }

    public function setAddresses(array $addresses): void
    {
        $this->addresses = $addresses;
    }

    public function setDiscountCodes(array $discount_codes): void
    {
        $this->discount_codes = $discount_codes;
    }

    public function setModifiedAt(array $modified_at): void
    {
        $this->modified_at = $modified_at;
    }

    public function setCreatedAt(array $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function setAdCampaigns(array $ad_campaigns): void
    {
        $this->ad_campaigns = $ad_campaigns;
    }

    public function setJuridical(?bool $juridical): void
    {
        $this->juridical = $juridical;
    }

    public function setSupplier(?bool $supplier): void
    {
        $this->supplier = $supplier;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

}
