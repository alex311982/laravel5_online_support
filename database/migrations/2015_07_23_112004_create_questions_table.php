<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the `Posts` table
        Schema::create('questions', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->unsignedInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                $table->unsignedInteger('user_id_edited')->nullable();
                $table->foreign('user_id_edited')->references('id')->on('users');
                $table->unsignedInteger('question_category_id')->nullable()->index();
                $table->foreign('question_category_id')->references('id')->on('question_categories')->onDelete('set null');
                $table->text('content');
                $table->unsignedInteger('country_id')->nullable()->index();
                $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
                $table->tinyInteger('is_displayed')->default(0);
                $table->timestamps();
                $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
