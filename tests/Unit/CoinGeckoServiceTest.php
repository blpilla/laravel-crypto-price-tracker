<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\CoinGeckoService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class CoinGeckoServiceTest extends TestCase
{
    public function testGetCurrentPrice()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['bitcoin' => ['usd' => 50000.00]])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $service = $this->getMockBuilder(CoinGeckoService::class)
            ->setMethods(['client'])
            ->getMock();

        $service->method('client')->willReturn($client);

        $price = $service->getCurrentPrice('bitcoin');

        $this->assertEquals(50000.00, $price);
    }
}