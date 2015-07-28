<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'countries', function(Blueprint $table){
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 50)->unique();
                $table->string('country_code', 10)->unique();
                $table->string('icon', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('countries');
    }
}
