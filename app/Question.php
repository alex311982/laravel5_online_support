<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'is_displayed'];

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
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get the post's author.
     *
     * @return User
     */
    public function answerer()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get the post's category.
     *
     * @return ArticleCategory
     */
    public function category()
    {
        return $this->belongsTo('App\QuestionCategory', 'question_category_id');
    }

    /**
     * Get the post's comments.
     *
     * @return array
     */
    public function answer()
    {
        return $this->hasOne('App\Answer');
    }

    /**
     * Get the post's category.
     *
     * @return ArticleCategory
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
