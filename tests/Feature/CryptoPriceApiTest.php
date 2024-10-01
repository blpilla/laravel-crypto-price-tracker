<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\CryptoPrice;
use Carbon\Carbon;

class CryptoPriceApiTest extends TestCase
{
    use RefreshDatabase;

    public function testGetLatestPrice()
    {
        CryptoPrice::create([
            'symbol' => 'btc',
            'price' => 50000.00,
            'timestamp' => now(),
        ]);

        $response = $this->get('/api/latest-price?crypto=btc');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'symbol',
                'price',
                'timestamp',
            ]);
    }

    public function testGetPriceAtTimestamp()
    {
        $timestamp = Carbon::now()->subHour();
        
        CryptoPrice::create([
            'symbol' => 'eth',
            'price' => 3000.00,
            'timestamp' => $timestamp,
        ]);

        $response = $this->get('/api/price-at-timestamp?crypto=eth&timestamp=' . $timestamp->toIso8601String());

        $response->assertStatus(200)
            ->assertJsonStructure([
                'symbol',
                'price',
                'timestamp',
            ]);
    }
}