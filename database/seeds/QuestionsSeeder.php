<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('questions')->truncate();

        factory(App\Question::class, 100)->create();
        factory(App\Answer::class, 100)->create();

    }
}
