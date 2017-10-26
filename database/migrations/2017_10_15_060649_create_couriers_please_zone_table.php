<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouriersPleaseZoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couriers_please_zone', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pcode');
            $table->string('locality');
            $table->string('state');
            $table->string('primary_pricing_zone');
            $table->string('secondary_pricing_zone');
            $table->string('pricing_zone');
            $table->string('ETA_ex_mel');
            $table->enum('status', array('0', '1'))->default('1');
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
        Schema::dropIfExists('couriers_please_zone');
    }
}
