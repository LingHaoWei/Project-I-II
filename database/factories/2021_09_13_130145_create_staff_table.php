<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('staffID');
            $table->string('image');
            $table->String('firstName');
            $table->String('lastName');
            $table->String('ICNumber');
            $table->String('position');
            $table->String('livingAddress');
            $table->String('city');
            $table->string('state');
            $table->String('zipcode');
            $table->integer('contactNumber');
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
        Schema::dropIfExists('staff');
    }
}
