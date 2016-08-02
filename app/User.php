<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_code', 'lastname', 'birthdate', 'url', 'soctype', 'avatar', 'newsletters'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function problems()
    {
        return $this->belongsToMany('App\Problem', 'user_problem')->withTimestamps()->withPivot('attempt', 'success');
    }

    public function account()
    {
        return $this->hasOne('App\Account');
    }
}
