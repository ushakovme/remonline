# Remonline client

## Installing

```shell
$ composer require ushakovme/remonline
```

## Usage

```php
<?php

use GuzzleHttp\Client;
use Ushakovme\Remonline\Remonline;
use Ushakovme\Remonline\Requests\ClientsRequest;
use Ushakovme\Remonline\Requests\OrdersRequest;
use Ushakovme\Remonline\TokenClient;

require 'vendor/autoload.php';

$guzzleClient = new Client([
    'base_uri' => 'https://api.remonline.ru',
    'timeout' => 3.0,
]);
$tokenClient = new TokenClient($guzzleClient, '12093b30a1054cd4b229b8bdb25da3df');

$token = $tokenClient->getToken();
echo "token: " . $token . PHP_EOL;

$remClient = new Remonline($guzzleClient, $token);
$clientsRequest = new ClientsRequest();
$clientsRequest->setNames(['Елена']);
$clientsResponse = $remClient->clients($clientsRequest);
echo "Total clients: " . $clientsResponse->getCount() . PHP_EOL;
foreach ($clientsResponse->getClients() as $client) {
    echo $client->getName() .': '. $client->getEmail() . PHP_EOL;
}

$ordersRequest = new OrdersRequest();
$ordersResponse = $remClient->orders($ordersRequest);
echo "Total orders: " . $ordersResponse->getCount() . PHP_EOL;

```

## License

MIT
