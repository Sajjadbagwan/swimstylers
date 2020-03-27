<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('branch_name')->nullable();
            $table->string('branch_desc')->nullable();
            $table->string('branch_image')->nullable();
           // $table->foreign('channel_id')->references('id')->on('channels')->onDelete('set null');
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
        Schema::dropIfExists('branch_master');
    }
}
