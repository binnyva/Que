<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use CrudTrait;
    
    protected $table = 'User';
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password'
    ];
}
