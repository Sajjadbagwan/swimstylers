<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pool_id');
            $table->date('start_date');
            $table->integer('number_of_weeks');
            $table->integer('number_of_weeks_notrun');
            $table->string('start_time');
            $table->string('end_time');
            $table->unsignedInteger('instructor_id');
            $table->decimal('price');
            $table->unsignedBigInteger('class_level');
            $table->date('booking_cut_off_date');
            $table->timestamps();

            $table->foreign('pool_id')->references('id')->on('pool_master');
            $table->foreign('instructor_id')->references('id')->on('admins');
            $table->foreign('class_level')->references('id')->on('level_master');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
