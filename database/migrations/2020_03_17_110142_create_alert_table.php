<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alert', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('alert_title');
            $table->text('alert_desc');
            $table->unsignedBigInteger('pool_id');
            $table->unsignedBigInteger('classes_id');
            $table->unsignedInteger('instructor_id');
            $table->unsignedInteger('branch_user_id');
            $table->boolean('show_home_page');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('pool_id')->references('id')->on('pool_master');
            $table->foreign('classes_id')->references('id')->on('classes');
            $table->foreign('instructor_id')->references('id')->on('admins');
            $table->foreign('branch_user_id')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alert');
    }
}
