<?php

namespace App;

use App\Question;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Tag extends Model
{
    use CrudTrait;
    
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

    protected $identifiableAttribute = 'name';

    public function questions()
    {
        return $this->belongsToMany('App\Question');
    }

}
