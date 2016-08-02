<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Action extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cost', 'description', 'account_id', 'pricetype_id', 'problem_id'
    ];

    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function pricetype()
    {
        return $this->belongsTo('App\Pricetype');
    }
    public function problem()
    {
        return $this->belongsTo('App\Problem');
    }

    public static function addAction($pricetypeCode, $userId = null, $description = null, $cost = null, $problemId = null)
    {
        if($userId === null) {
            $userId = Auth::user()->id;
        }

        $account = Account::firstOrCreate(['user_id' => $userId]);

        $pricetype = Pricetype::whereCode($pricetypeCode)->first();
        
        $action = new self();
        $action->pricetype_id = $pricetype->id;
        $action->account_id = $account->id;

        $action->description = $description;

        if($cost === null) {
            $cost = $pricetype->price;
        }
        $action->cost = $cost;
        $account->balance += $cost;
        $account->save();

        $action->problem_id = $problemId;

        $action->save();
    }
}
