<?php

namespace App\Services;

use GuzzleHttp\Client;

class CoinGeckoService
{
    protected $client;
    protected $baseUrl = 'https://api.coingecko.com/api/v3';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 10.0,
        ]);
    }

    public function getCurrentPrice($crypto)
    {
        $response = $this->client->get('/simple/price', [
            'query' => [
                'ids' => $crypto,
                'vs_currencies' => 'usd',
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data[$crypto]['usd'];
    }
}