<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoPrice extends Model
{
    protected $fillable = ['symbol', 'price', 'timestamp'];

    protected $casts = [
        'price' => 'float',
        'timestamp' => 'datetime',
    ];
}