<?php

namespace App;

use App\Tag;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'Question';
    public $timestamps = true;
    const CREATED_AT = 'added_on';
    const UPDATED_AT = 'updated_on';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'source', 'points', 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'added_on' => 'datetime',
        'updated_on'=>'datetime'
    ];

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'QuestionTag');
    }
}
