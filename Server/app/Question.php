<?php

namespace App;

use App\Tag;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Question extends Model
{
    use CrudTrait;
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

    public function source()
    {
        return $this->belongsTo('App\Source');
    }

    // Returs all questions which is tagged with ANY of the given tags.
    public function withTags($tags)
    {
        $q = app('db')->table('Question');
        $q->join("QuestionTag", 'Question.id', '=', 'QuestionTag.question_id');
        $q->join("Tag", 'Tag.id', '=', 'QuestionTag.tag_id');
        $q->whereIn("Tag.name", $tags);
        $q->where("Question.status", '1');

        return $q->inRandomOrder()->first();
    }

    // Returns all questions which is tagged with ALL of the given tags.
    public function withAllTags($tags)
    {
        // Lifted straight off https://stackoverflow.com/questions/3876240/need-help-with-sql-query-to-find-things-tagged-with-all-specified-tags
        $result = collect(app('db')->select("SELECT Q.*,Q.id AS question_id FROM Question Q
            JOIN (SELECT QT.question_id
                    FROM QuestionTag QT
                    JOIN Tag T ON T.id = QT.tag_id
                    WHERE T.name IN ('" .implode("','", $tags) . "')
                    GROUP BY QT.question_id
                    HAVING COUNT(DISTINCT T.name) = " . count($tags) . ") X ON X.question_id = Q.id")->inRandomOrder()->first());

        return $result;
    }
}
