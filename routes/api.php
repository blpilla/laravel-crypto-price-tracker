<?php

use Illuminate\Http\Request;

Route::middleware('api')->group(function () {
    Route::get('/latest-price', 'CryptoPriceController@getLatestPrice');
    Route::get('/price-at-timestamp', 'CryptoPriceController@getPriceAtTimestamp');
});