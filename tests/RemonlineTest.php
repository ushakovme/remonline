<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Ushakovme\Remonline\RemonlineClient;
use Ushakovme\Remonline\Requests\ClientsRequest;
use Ushakovme\Remonline\Requests\OrdersRequest;
use Ushakovme\Remonline\TokenClient;
use PHPUnit\Framework\TestCase;

class RemonlineTest extends TestCase
{
    public function testClients(): void
    {
        $responseBody = '{
  "count": 1,
  "data": [
    {
      "id": 1,
      "name": "Андрей А.А.",
      "phone": [
        "(123) 456-78-90",
        "(098) 765-43-21"
      ],
      "email": "some@site.domain",
      "notes": "Платит не вовремя.",
      "address": "г. Город, ул. Улица д.12, кв.34",
      "supplier": false,
      "juridical": false,
      "conflicted": true,
      "modified_at": 1454278600000,
      "created_at": 1454278610000,
      "discount_code": "2900000000018",
      "discount_goods": 0,
      "discount_services": 5,
      "discount_materials": 25,
      "discount_goods_margin_id": 136752,
      "discount_materials_margin_id": 136751,
      "custom_fields": {
        "1": "Some custom value"
      },
      "ad_campaign": {
        "id": 1,
        "name": "Internet"
      }
    }
  ],
  "success": true
}';
        $mock = new MockHandler([
            new Response(200, [], $responseBody),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $remClient = new RemonlineClient($client, 'token');
        $clientsRequest = new ClientsRequest();
        $clientsResponse = $remClient->clients($clientsRequest);

        $this->assertEquals(1, $clientsResponse->getCount());
        $this->assertCount(1, $clientsResponse->getClients());
        $client = $clientsResponse->getClients()[0];
        $this->assertEquals(1, $client->getId());
        $this->assertEquals('Андрей А.А.', $client->getName());
        $this->assertEquals([
            "(123) 456-78-90",
            "(098) 765-43-21"
        ], $client->getPhone());
        $this->assertEquals('some@site.domain', $client->getEmail());
        $this->assertEquals('Платит не вовремя.', $client->getNotes());
        $this->assertEquals('г. Город, ул. Улица д.12, кв.34', $client->getAddress());
        $this->assertEquals(false, $client->isSupplier());
        $this->assertEquals(false, $client->isJuridical());
        $this->assertEquals(true, $client->isConflicted());
        $this->assertEquals((new DateTime())->setTimestamp(1454278600), $client->getModifiedAt());
        $this->assertEquals((new DateTime())->setTimestamp(1454278610), $client->getCreatedAt());
        $this->assertEquals('2900000000018', $client->getDiscountCode());
        $this->assertEquals(0, $client->getDiscountGoods());
        $this->assertEquals(5, $client->getDiscountServices());
        $this->assertEquals(25, $client->getDiscountMaterials());
        $this->assertEquals(136752, $client->getDiscountGoodsMarginId());
        $this->assertEquals(136751, $client->getDiscountMaterialsMarginId());
    }

    public function testOrders(): void
    {
        $responseBody = '{
  "count": 1,
  "data": [
    {
      "id": 1,
      "brand": "my brand",
      "model": "Sony Ericsson K800i",
      "price": 1700,
      "payed": 1200,
      "resume": "my res",
      "urgent": false,
      "serial": "356128022598709",
      "client": {
        "id": 142,
        "phone": [
          "+7 (947) 294-82-93"
        ],
        "address": "г. Город, ул. Улица д.12, кв.34",
        "name": "Jack London",
        "email": "",
        "modified_at": 1454278600000,
        "notes": "Платит вовремя.",
        "supplier": false,
        "juridical": false,
        "conflicted": true,
        "discount_code": "2900000000018",
        "discount_goods": 0,
        "discount_services": 5,
        "discount_materials": 25,
        "custom_fields": {
          "1": "Some custom value"
        },
        "ad_campaign": {
          "id": 1,
          "name": "Internet"
        }
      },
      "ad_campaign": {
        "id": 1,
        "name": "Internet"
      },
      "status": {
        "id": 828,
        "name": "New",
        "group": 1,
        "color": "#999999"
      },
      "done_at": 1456137000000,
      "overdue": false,
      "engineer_id": 11,
      "manager_id": 12,
      "branch_id": 218,
      "appearance": "Scratches, abrasions",
      "created_by_id": 14,
      "order_type": {
        "id": 16,
        "title": "VIP"
      },
      "parts": [
        {
          "id": 1,
          "engineer_id": 9130,
          "title": "Display",
          "cost": 100,
          "price": 150,
          "discount_value": 25,
          "amount": 1,
          "warranty": 6,
          "warranty_period": 1
        }
      ],
      "operations": [
        {
          "id": 18,
          "engineer_id": 9130,
          "title": "Diagnostics",
          "cost": 20,
          "price": 25,
          "discount_value": 5,
          "amount": 11,
          "warranty": 1,
          "warranty_period": 10
        }
      ],
      "taxes": [
        {
          "code": "1212",
          "type": 2,
          "sum": 280
        }
      ],
      "attachments": [
        {
          "created_by_id": 11,
          "created_at": 1521040338000,
          "url": "/documents/download/6729cff9b6c8401aae544c2c1006f296",
          "filename": "file.pdf"
        }
      ],
      "created_at": 1456131000000,
      "scheduled_for": null,
      "closed_at": 1456137100000,
      "modified_at": 1456137000000,
      "packagelist": "my packagelist",
      "kindof_good": "Smartphone",
      "malfunction": "Broken display",
      "id_label": "W1",
      "closed_by_id": 1,
      "custom_fields": {
        "1": "Some custom value"
      },
      "warranty_date": 1459237000000,
      "manager_notes": "mng",
      "estimated_cost": 1700,
      "engineer_notes": "engn",
      "warranty_granted": true,
      "estimated_done_at": 1456133000000
    }
  ],
  "page": 1,
  "success": true
}';
        $mock = new MockHandler([
            new Response(200, [], $responseBody),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $httpClient = new Client(['handler' => $handlerStack]);

        $remClient = new RemonlineClient($httpClient, 'token');
        $orderRequest = new OrdersRequest();
        $ordersResponse = $remClient->orders($orderRequest);

        $this->assertEquals(1, $ordersResponse->getCount());
        $this->assertEquals(1, $ordersResponse->getPage());
        $this->assertCount(1, $ordersResponse->getOrders());
        $order = $ordersResponse->getOrders()[0];
        $this->assertEquals(1, $order->getId());
        $this->assertEquals('my brand', $order->getBrand());
        $this->assertEquals('Sony Ericsson K800i', $order->getModel());
        $this->assertEquals(1700, $order->getPrice());
        $this->assertEquals(1200, $order->getPayed());
        $this->assertEquals('my res', $order->getResume());
        $this->assertEquals(false, $order->isUrgent());
        $this->assertEquals('356128022598709', $order->getSerial());

        $adCampaign = $order->getAdCampaign();
        $this->assertEquals(1, $adCampaign->getId());
        $this->assertEquals('Internet', $adCampaign->getName());

        $status = $order->getStatus();
        $this->assertEquals(828, $status->getId());
        $this->assertEquals('New', $status->getName());
        $this->assertEquals(1, $status->getGroup());
        $this->assertEquals('#999999', $status->getColor());

        $this->assertEquals((new DateTime())->setTimestamp(1456137000), $order->getDoneAt());
        $this->assertEquals(false, $order->isOverdue());
        $this->assertEquals(11, $order->getEngineerId());
        $this->assertEquals(12, $order->getManagerId());
        $this->assertEquals(218, $order->getBranchId());
        $this->assertEquals('Scratches, abrasions', $order->getAppearance());
        $this->assertEquals(14, $order->getCreatedById());

        $orderType = $order->getOrderType();
        $this->assertEquals(16, $orderType->getId());
        $this->assertEquals('VIP', $orderType->getTitle());

        $parts = $order->getParts();
        $this->assertCount(1, $parts);
        $part = $parts[0];
        $this->assertEquals(1, $part->getId());
        $this->assertEquals(9130, $part->getEngineerId());
        $this->assertEquals('Display', $part->getTitle());
        $this->assertEquals(100, $part->getCost());
        $this->assertEquals(150, $part->getPrice());
        $this->assertEquals(25, $part->getDiscountValue());
        $this->assertEquals(1, $part->getAmount());
        $this->assertEquals(6, $part->getWarranty());
        $this->assertEquals(1, $part->getWarrantyPeriod());

        $operations = $order->getOperations();
        $this->assertCount(1, $operations);
        $operation = $operations[0];
        $this->assertEquals(18, $operation->getId());
        $this->assertEquals(9130, $operation->getEngineerId());
        $this->assertEquals('Diagnostics', $operation->getTitle());
        $this->assertEquals(20, $operation->getCost());
        $this->assertEquals(25, $operation->getPrice());
        $this->assertEquals(5, $operation->getDiscountValue());
        $this->assertEquals(11, $operation->getAmount());
        $this->assertEquals(1, $operation->getWarranty());
        $this->assertEquals(10, $operation->getWarrantyPeriod());

        $taxes = $order->getTaxes();
        $this->assertCount(1, $taxes);
        $tax = $taxes[0];
        $this->assertEquals('1212', $tax->getCode());
        $this->assertEquals(2, $tax->getType());
        $this->assertEquals(280, $tax->getSum());

        $attachments = $order->getAttachments();
        $this->assertCount(1, $attachments);
        $attachment = $attachments[0];
        $this->assertEquals(11, $attachment->getCreatedById());
        $this->assertEquals((new DateTime())->setTimestamp(1521040338000), $attachment->getCreatedAt());
        $this->assertEquals('/documents/download/6729cff9b6c8401aae544c2c1006f296', $attachment->getUrl());
        $this->assertEquals('file.pdf', $attachment->getFilename());

        $this->assertEquals((new DateTime())->setTimestamp(1456131000), $order->getCreatedAt());
        $this->assertEquals(null, $order->getScheduledFor());
        $this->assertEquals((new DateTime())->setTimestamp(1456137100), $order->getClosedAt());
        $this->assertEquals((new DateTime())->setTimestamp(1456137000), $order->getModifiedAt());
        $this->assertEquals('my packagelist', $order->getPackagelist());
        $this->assertEquals('Smartphone', $order->getKindofGood());
        $this->assertEquals('Broken display', $order->getMalfunction());
        $this->assertEquals('W1', $order->getIdLabel());
        $this->assertEquals(1, $order->getClosedById());
        $this->assertEquals((new DateTime())->setTimestamp(1459237000), $order->getWarrantyDate());
        $this->assertEquals('mng', $order->getManagerNotes());
        $this->assertEquals(1700, $order->getEstimatedCost());
        $this->assertEquals('engn', $order->getEngineerNotes());
        $this->assertEquals(true, $order->isWarrantyGranted());
        $this->assertEquals((new DateTime())->setTimestamp(1456133000), $order->getEstimatedDoneAt());

        $customFields = $order->getCustomFields();
        $this->assertEquals('Some custom value', $customFields->get("1"));
    }


}
