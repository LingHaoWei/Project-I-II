<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfflineOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offline_orders', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'order_no');
            $table->string(column: 'notes');
            $table->integer(column: 'status');
            $table->string(column: 'invoice_no');
            $table->string(column: 'payment');
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
        Schema::dropIfExists('offline_orders');
    }
}
