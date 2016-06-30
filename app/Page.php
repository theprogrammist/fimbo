<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public static $fields = ['title' => 'Заголовок страницы',
        'undertitle' => 'Текст под заголовком',
        'youtubelink' => 'Линк на видео для главной',
        'learn' => 'Заголовок блока "изучай..."',
        'learnbubble' => 'Текстовый бабл блока "изучай..."',
        'solve' => 'Заголовок блока "решай..."',
        'solvebubble' => 'Текстовый бабл блока "решай..."',
        'use' => 'Заголовок блока "используй..."',
        'useicontext1' => 'Текст к иконке 1',
        'useicontext2' => 'Текст к иконке 2',
        'useicontext3' => 'Текст к иконке 3',
        'earn' => 'Заголовок блока "зарабатывай..."',
        'earnicontext1' => 'Текст к иконке 1',
        'earnicontext2' => 'Текст к иконке 2',
        'earnicontext3' => 'Текст к иконке 3',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'title', 'content', 'parent_id', 'number', 'difficulty', 'course'
    ];

    public function parent()
    {
        return $this->belongsTo(get_class($this), 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(get_class($this), 'parent_id');
    }

    public static function getTree()
    {
        $zeroLevel = self::whereParentId(null)->get();
    }
}
