<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = [
        'title', 'description', 'question', 'answer', 'number', 'score', 'attempts', 'difficulty', 'course_id'
    ];


    public function users()
    {
        return $this->belongsToMany('App\User', 'user_problem')->withTimestamps()->withPivot('attempt', 'success');
    }

    public function lections()
    {
        return $this->belongsToMany('App\Page', 'problem_lection', 'problem_id', 'lection_id')->withTimestamps();
    }
}
