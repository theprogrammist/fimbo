<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //'red', 'green', 'blue', 'purple', 'orange', 'yellow'
    protected $fillable = [
        'title', 'description', 'color'
    ];

    public static $colors = ['red' => 'Красный',
        'green' => 'Зеленый',
        'blue' => 'Голубой',
        'purple' => 'Фиолетовый',
        'orange' => 'Оранжевый',
        'yellow' => 'Желтый',
        'olive' => 'Оливковый',];

    public function lections()
    {
        return $this->hasMany('App\Page');
    }
}
