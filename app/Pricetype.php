<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricetype extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'description', 'price'
    ];

    public function actions()
    {
        return $this->hasMany('App\Action');
    }
}
