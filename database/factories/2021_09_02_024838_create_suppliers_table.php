<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplierID');
            $table->String('supplierName');
            $table->String('address');
            $table->String('state');
            $table->String('city');
            $table->String('zipcode');
            $table->String('companyEmail');
            $table->string('contactPerson');
            $table->String('contactNumber');
            $table->String('emailAddress');
            $table->String('status');
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
        Schema::dropIfExists('suppliers');
    }
}
