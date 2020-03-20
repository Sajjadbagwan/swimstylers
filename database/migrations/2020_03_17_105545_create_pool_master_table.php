<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoolMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('pool_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('attachment_id');
            $table->string('class_pool');
            $table->string('address1');
            $table->string('address2');
            $table->string('address3');
            $table->string('address4');
            $table->string('general_note');
            $table->string('pool_code');
            $table->string('country');
            $table->integer('telephone_number');
            $table->string('email_address');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('car_parking_note');
            $table->string('cartering_note');
            $table->string('lokers_note');
            $table->string('disable_acsess_note');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branch_master');
            $table->foreign('attachment_id')->references('id')->on('attachment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pool_master');
    }
}
