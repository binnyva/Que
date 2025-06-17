<?php

namespace App;

use App\Tag;
use App\Question;
use Illuminate\Database\Eloquent\Model;

class QuestionTag extends Model
{
    protected $table = 'QuestionTag';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id', 'tag_id'
    ];


    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
