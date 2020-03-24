<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins_detail', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('user_id');
            $table->text('profile_dsec');
            $table->string('dbs_doc_file');
            $table->string('ios_cert_file');
            $table->string('signed_contract_file');
            $table->integer('max_teach_level_name');
            $table->integer('max_teach_level_stage');
            $table->string('job_title');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('admins');
            $table->foreign('branch_id')->references('id')->on('branch_master');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins_detail');
    }
}
