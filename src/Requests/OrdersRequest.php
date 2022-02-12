<?php

declare(strict_types=1);

namespace Ushakovme\Remonline\Requests;

final class OrdersRequest implements RequestInterface
{
    private int $page = 1;
    /**
     * asc|desc - Направление сортировки заказов;
     */
    private string $sort_dir = 'desc';
    /**
     * Массив идентификаторов типов заказа
     */
    private array $types = [];
    /**
     * Перечень идентификаторов локаций
     */
    private array $branches = [];
    /**
     * Перечень брендов
     */
    private array $brands = [];

    /**
     * Массив системных идентификаторов заказов
     */
    private array $ids = [];
    /**
     *  Массив идентификаторов заказов
     */
    private array $id_labels = [];
    /**
     * Массив идентификаторов статусов для заказа
     */
    private array $statuses = [];
    /**
     *  Массив идентификаторов сотрудников компании
     */
    private array $managers = [];
    /**
     * Массив идентификаторов сотрудников компании
     */
    private array $engineers = [];
    /**
     * Массив идентификаторов клиентов
     */
    private array $clients_ids = [];
    /**
     * Перечень имен клиентов
     */
    private array $client_names = [];
    /**
     *  Перечень телефонных номеров клиентов
     */
    private array $client_phones = [];
    /**
     * Фильтр по дате создания.
     * Массив из одного либо двух значений, которые содержат в себе timestamp.
     * В случае, если массив состоит из одного значения, то оно является левой границей.
     * Примеры: [0, 1454277600000], [1454277500000]
     */
    private array $created_at = [];
    /**
     * Фильтр по дате готовности.
     * Массив из одного либо двух значений, которые содержат в себе timestamp.
     * В случае, если массив состоит из одного значения, то оно является левой границей.
     * Примеры: [1454277600000, 1456783200000], [1454277500000]
     */
    private array $done_at = [];
    /**
     * Фильтр по дате изменения заказа
     */
    private array $modified_at = [];

    /**
     * Фильтр по дате выдачи.
     * Массив из одного либо двух значений, которые содержат в себе timestamp.
     * В случае, если массив состоит из одного значения, то оно является левой границей.
     * Примеры: [1456783200000, 1454925794507], [1454277500000]
     */
    private array $closed_at = [];


    public function toArray(): array
    {
        $data = [
            'sort_dir' => $this->sort_dir,
            'page' => $this->page,
        ];

        if (!empty($this->names)) {
            $data['names'] = $this->names;
        }
        if (!empty($this->types)) {
            $data['types'] = $this->types;
        }
        if (!empty($this->branches)) {
            $data['branches'] = $this->branches;
        }
        if (!empty($this->brands)) {
            $data['brands'] = $this->brands;
        }
        if (!empty($this->ids)) {
            $data['ids'] = $this->ids;
        }
        if (!empty($this->id_labels)) {
            $data['id_labels'] = $this->id_labels;
        }
        if (!empty($this->statuses)) {
            $data['statuses'] = $this->statuses;
        }
        if (!empty($this->managers)) {
            $data['managers'] = $this->managers;
        }
        if (!empty($this->engineers)) {
            $data['engineers'] = $this->engineers;
        }
        if (!empty($this->clients_ids)) {
            $data['clients_ids'] = $this->clients_ids;
        }
        if (!empty($this->client_names)) {
            $data['client_names'] = $this->client_names;
        }
        if (!empty($this->client_phones)) {
            $data['client_phones'] = $this->client_phones;
        }
        if (!empty($this->created_at)) {
            $data['created_at'] = $this->created_at;
        }
        if (!empty($this->done_at)) {
            $data['done_at'] = $this->done_at;
        }
        if (!empty($this->closed_at)) {
            $data['closed_at'] = $this->closed_at;
        }
        if (!empty($this->modified_at)) {
            $data['modified_at'] = $this->modified_at;
        }

        return $data;
    }

    public function setSortDir(string $sort_dir): void
    {
        $this->sort_dir = $sort_dir;
    }

    public function setTypes(array $types): void
    {
        $this->types = $types;
    }

    public function setBranches(array $branches): void
    {
        $this->branches = $branches;
    }

    public function setBrands(array $brands): void
    {
        $this->brands = $brands;
    }

    public function setIds(array $ids): void
    {
        $this->ids = $ids;
    }

    public function setIdLabels(array $id_labels): void
    {
        $this->id_labels = $id_labels;
    }

    public function setStatuses(array $statuses): void
    {
        $this->statuses = $statuses;
    }

    public function setManagers(array $managers): void
    {
        $this->managers = $managers;
    }

    public function setEngineers(array $engineers): void
    {
        $this->engineers = $engineers;
    }

    public function setClientsIds(array $clients_ids): void
    {
        $this->clients_ids = $clients_ids;
    }

    public function setClientNames(array $client_names): void
    {
        $this->client_names = $client_names;
    }

    public function setClientPhones(array $client_phones): void
    {
        $this->client_phones = $client_phones;
    }

    public function setCreatedAt(array $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function setDoneAt(array $done_at): void
    {
        $this->done_at = $done_at;
    }

    public function setModifiedAt(array $modified_at): void
    {
        $this->modified_at = $modified_at;
    }

    public function setClosedAt(array $closed_at): void
    {
        $this->closed_at = $closed_at;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }
}
