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
            $table->string(column: 'invoiceNo');
            $table->integer(column: 'total');
            $table->integer(column: 'supplierID');
            $table->integer(column: 'active');
            $table->integer(column: 'status');
            $table->integer(column: 'userModified');
            $table->date(column: 'date');
            $table->text(column: 'information')->nullable();
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
        Schema::dropIfExists('purchase_oder_r_s');
    }
}
