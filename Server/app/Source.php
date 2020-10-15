<?php

namespace App;

use App\Question;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Source extends Model
{
    use CrudTrait;
    
    protected $table = 'Source';
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
        return $this->hasMany('App\Question');
    }
}
