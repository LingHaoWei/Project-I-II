<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOderRSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_oder_r_s', function (Blueprint $table) {
            $table->bigIncrements(column: 'id');
            $table->integer(column: 'purchase_order')->unsigned();
            $table->integer(column: 'productID')->unsigned();
            $table->double(column: 'unitPrice', total: 10, places: 2);

            $table->foreign('purchase_orders')->references('id')->on('purchase_orders')->onDelete('cascade');
            $table->foreign('products')->references('id')->on('products')->onDelete('restrict');
                
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_oder_r_s');
    }
}
