<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->integer('suburb_id');
            $table->string('postal_code')->nullable();
            $table->string('website')->nullable();
            $table->string('account_type')->nullable();
            $table->string('user_found')->nullable();
            $table->string('account_number')->nullable();
            $table->string('user_type')->default('customer');
            $table->enum('sender_type', array('business', 'residential'))->default('business');
            $table->enum('receiver_type', array('business', 'residential'))->default('business');
            $table->string('timezone')->nullable();
            $table->enum('online_status', array('0', '1'))->default('0');
            $table->enum('status', array('0', '1'))->default('0');
            $table->enum('set_default', array('0', '1'))->default('0');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
