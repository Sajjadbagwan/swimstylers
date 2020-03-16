<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claases_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('class_name');
            $table->string('start_date');
            $table->integer('number_of_weeks')->nullable();
            $table->integer('number_of_weeks_notrun')->nullable();
            $table->text('start_time')->nullable();
            $table->text('end_time')->nullable();
            $table->integer('instructor_id')->unsigned();
            $table->string('price');
            $table->unique(['booking_cut_off_date', 'slug', 'locale']);
            $table->unique(['created_at', 'slug', 'locale']);
            //$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes_translations');
    }
}