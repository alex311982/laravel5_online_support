<?php

use Illuminate\Database\Seeder;

class QuestionCategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('question_categories')->truncate();

        \App\QuestionCategory::create([
                'name' => 'Category 1',
            ]);

        \App\QuestionCategory::create([
                'name' => 'Category 2',
            ]);

        \App\QuestionCategory::create([
                'name' => 'Category 3',
            ]);

    }

}