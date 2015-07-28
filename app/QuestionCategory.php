<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionCategory extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = "question_categories";

    /**
     * Get the slider's images.
     *
     * @return array
     */
    public function questions()
    {
        return $this->hasMany('App\Question');
    }

}
