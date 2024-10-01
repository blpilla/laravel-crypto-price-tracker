<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCryptoPricesTable extends Migration
{
    public function up()
    {
        Schema::create('crypto_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('symbol');
            $table->decimal('price', 18, 8);
            $table->timestamp('timestamp');
            $table->timestamps();

            $table->index(['symbol', 'timestamp']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('crypto_prices');
    }
}