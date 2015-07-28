<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the `Posts` table
        Schema::create('questions_countries', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->unsignedInteger('question_id')->nullable()->index();
                $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
                $table->unsignedInteger('country_id')->nullable()->index();
                $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
                $table->unsignedInteger('count')->default(0);
                $table->timestamps();
                $table->unique( array('question_id','country_id') );
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions_countries');
    }
}