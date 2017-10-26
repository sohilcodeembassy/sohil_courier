<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricingPortalApi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_portal_api', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('api_id');
            $table->enum('api_type', array('domestic', 'international'))->default('domestic');
            $table->float('price_modifier', 8, 2);
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
        Schema::dropIfExists('pricing_portal_api');
    }
}
