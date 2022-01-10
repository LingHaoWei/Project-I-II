<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productID');
            $table->string('name');
            $table->string('description');
            $table->integer('quantity')->unsigned();
            $table->double('price',8,2);
            $table->double('unitPrice',8,2);
            $table->string('productVariety');
            $table->string('productSKU');
            $table->string('image');
            $table->string('categoryID');
            $table->string('brandID');
            $table->string('supplierID');
            $table->string('status');
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
        Schema::dropIfExists('products');
    }
}
