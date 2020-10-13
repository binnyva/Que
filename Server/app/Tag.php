<?php

namespace App;

use App\Question;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'Tag';
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function questions()
    {
        return $this->belongsToMany('App\Question');
    }
}
