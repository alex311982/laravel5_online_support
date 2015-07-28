<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the `Posts` table
        Schema::create('answers', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->unsignedInteger('user_id_answered')->nullable();
                $table->foreign('user_id_answered')->references('id')->on('users');
                $table->unsignedInteger('question_id')->nullable();
                $table->foreign('question_id')->references('id')->on('questions')->onDelete('set null');
                $table->text('content')->nullable();
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
        Schema::drop('answers');
    }
}
