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
            $table->String(column: 'productID');
            $table->double(column: 'unitPrice', total: 10, places: 2);
            $table->integer(column: 'quantity');
            $table->double(column: 'grand_total', total: 10, places: 2);
                
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
