<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfflineOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offline_order__details', function (Blueprint $table) {
            $table->id();
            $table->integer(column: 'orderID')->unsigned();
            $table->String(column: 'productID');
            $table->double(column: 'Price', total: 10, places: 2);
            $table->integer(column: 'quantity');
            $table->double(column: 'grand_total', total: 10, places: 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offline_order__details');
    }
}
