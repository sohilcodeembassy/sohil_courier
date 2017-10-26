<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGstlevyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Gstlevy', function (Blueprint $table) {
            $table->increments('id');
            $table->float('gst', 8, 2);
            $table->float('couriers_please_fuel_levy', 8, 2);
            $table->float('startrack_fuel_levy', 8, 2);
            $table->float('residential_charge_call', 8, 2);
            $table->float('traillift_charge', 8, 2);
            $table->float('manual_handling_fee', 8, 2);
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
        Schema::dropIfExists('Gstlevy');
    }
}
