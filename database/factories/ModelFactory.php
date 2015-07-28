<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Question::class, function ($faker) {

        return [
            'user_id' => rand(1, 3),
            'question_category_id' => rand(1, 3),
            'content' => $faker->text,
            'is_displayed' => 1,
            'question_category_id' => rand(1, 3),
            'country_id' => rand(1, 4)
        ];
    });

$factory->define(App\Answer::class, function ($faker) {

        return [
            'question_id' => rand(1, 5),
            'user_id_answered' => 1,
            'content' => $faker->text,
        ];
    });

$factory->define(App\QuestionsCountry::class, function ($faker) {

        static $data = array();

        do {
            $country = $faker->numberBetween($min = 1, $max = 4);
            $question = $faker->numberBetween($min = 1, $max = 10);
            $arr = array($country, $question);
        } while(in_array($arr, $data));

        $data[] = $arr;

        return [
            'country_id' => $country,
            'question_id' => $question,
            'count' => rand(1, 30)
        ];
    });
