<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('mobile_number');
            $table->string('email_address');
            $table->date('date_of_birth');
            $table->text('health');
            $table->integer('current_swim_level');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendee');
    }
}
