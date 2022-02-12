<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Ushakovme\Remonline\TokenClient;
use PHPUnit\Framework\TestCase;

class TokenClientTest extends TestCase
{
    public function testGetToken()
    {
        $mockedToken = '7bab555b5ed075353de2263dd50a394c84a4625a';
        $body = json_encode(['token' => $mockedToken]);
        $mock = new MockHandler([
            new Response(200, [], $body),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $tokenClient = new TokenClient($client, 'apiKey');
        $this->assertEquals($mockedToken, $tokenClient->getToken());
    }

    public function testEmptyToken()
    {
        $this->expectException(Exception::class);

        $mock = new MockHandler([
            new Response(200, [], ''),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $tokenClient = new TokenClient($client, 'apiKey');
        $tokenClient->getToken();
    }
}
