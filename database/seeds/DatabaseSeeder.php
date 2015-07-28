<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Eloquent::unguard();

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // supposed to only apply to a single connection and reset it's self
        // but I like to explicitly undo what I've done for clarity


        // Add calls to Seeders here
        $this->call('CountriesTableSeeder');
        $this->call('QuestionCategoryTableSeeder');
        $this->call('UsersTableSeeder');
		$this->call('QuestionsTableSeeder');
		$this->call('QuestionsCountryTableSeeder');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Model::reguard();
    }
}
