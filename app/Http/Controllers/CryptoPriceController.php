<?php

namespace App\Http\Controllers;

use App\Services\CoinGeckoService;
use App\Models\CryptoPrice;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CryptoPriceController extends Controller
{
    protected $coinGeckoService;

    public function __construct(CoinGeckoService $coinGeckoService)
    {
        $this->coinGeckoService = $coinGeckoService;
    }

    public function getLatestPrice(Request $request)
    {
        $request->validate([
            'crypto' => 'required|string',
        ]);

        $crypto = strtolower($request->input('crypto'));
        $latestPrice = CryptoPrice::where('symbol', $crypto)
            ->latest('timestamp')
            ->first();

        if (!$latestPrice) {
            $price = $this->coinGeckoService->getCurrentPrice($crypto);
            $latestPrice = CryptoPrice::create([
                'symbol' => $crypto,
                'price' => $price,
                'timestamp' => now(),
            ]);
        }

        return response()->json([
            'symbol' => $latestPrice->symbol,
            'price' => $latestPrice->price,
            'timestamp' => $latestPrice->timestamp,
        ]);
    }

    public function getPriceAtTimestamp(Request $request)
    {
        $request->validate([
            'crypto' => 'required|string',
            'timestamp' => 'required|date_format:Y-m-d\TH:i:s\Z',
        ]);

        $crypto = strtolower($request->input('crypto'));
        $timestamp = Carbon::parse($request->input('timestamp'));

        $price = CryptoPrice::where('symbol', $crypto)
            ->where('timestamp', '<=', $timestamp)
            ->orderBy('timestamp', 'desc')
            ->first();

        if (!$price) {
            return response()->json([
                'error' => 'No price data available for the specified time.',
            ], 404);
        }

        return response()->json([
            'symbol' => $price->symbol,
            'price' => $price->price,
            'timestamp' => $price->timestamp,
        ]);
    }
}