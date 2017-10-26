<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->enum('type', ['domestic', 'international'])->default('domestic');
            $table->enum('status', ['0', '1'])->default('0');
            $table->string('access_quote_live_url')->nullable();
            $table->string('access_booking_live_url')->nullable();
            $table->string('access_label_live_url')->nullable();
            $table->string('access_live_usernm')->nullable();
            $table->string('access_live_password')->nullable();
            $table->string('access_quote_test_url')->nullable();
            $table->string('access_booking_test_url')->nullable();
            $table->string('access_label_test_url')->nullable();
            $table->string('access_test_usernm')->nullable();
            $table->string('access_test_password')->nullable();
            $table->enum('mode', ['live', 'test'])->default('test');
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
        Schema::dropIfExists('api');
    }
}
