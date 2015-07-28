<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content'];

    /**
     * Returns a formatted post content entry,
     * this ensures that line breaks are returned.
     *
     * @return string
     */
    public function content()
    {
        return nl2br($this->content);
    }

    /**
     * Get the post's author.
     *
     * @return User
     */
    public function answerer()
    {
        return $this->belongsTo('App\User', 'user_id_answered');
    }

    /**
     * Get the post's question.
     *
     * @return Question
     */
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
