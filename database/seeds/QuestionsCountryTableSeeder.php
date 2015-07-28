<?php

use Illuminate\Database\Seeder;

class QuestionsCountryTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('questions_countries')->truncate();

        factory(App\QuestionsCountry::class, 40)->create();

    }
}
