<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Page;
use App\Problem;
use Validator;
use Auth;
use Log;
use App;

class ProblemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($problemId = null, Request $request)
    {
        $problem = Problem::find($problemId);

        session(['lastOpenedProblemId' => $problemId]);

        if(Auth::user()->problems->find($problemId)) {
            $retry = (Auth::user()->problems->find($problemId)->pivot->attempt < 2) && ($problem->attempts > 1);
            $success = (bool) Auth::user()->problems->find($problemId)->pivot->success;
        } else {
            $retry = null;
            $success = null;
        }

        return view('home', ['problem' => $problem,
            'question' => json_decode($problem->question),
            'retry' => $retry,
            'success' => $success,
        ]);
    }

    public function solution($problemId = null, Request $request)
    {

        $problem = Problem::find($problemId);
        $question = json_decode($problem->question);

        $success = false;
        if( !($request->has('skip_question') && $request->input('skip_question') == 'skip')) {

            if ($question->type == 'single') {

                if ($request->has('single')) {
                    $success = ($request->input('single') == $question->single);
                }

            } elseif ($question->type == 'radio') {

                if ($request->has('radio')) {
                    $success = (intval($request->input('radio')) == intval($question->radio->number));
                }

            } elseif ($question->type == 'checkbox') {

                if ($request->has('checkbox')) {
                    $b = (array)$question->checkbox->numbers;
                    $a = $request->input('checkbox');
                    sort($a);
                    sort($b);
                    $success = ($a == $b);
                }
            }

        }

        $attempt = 1;
        if( Auth::user()->problems()->whereProblemId($problemId)->count() == 0) {

            Auth::user()->problems()->attach($problemId,['attempt' => 1, 'success' => $success]);

        } elseif( Auth::user()->problems()->whereProblemId($problemId)->count() == 1) {
            //var_dump(Auth::user()->problems()->whereProblemId($problemId)->get()->pivot->attempt); fails -- WTF???

            if(Auth::user()->problems->find($problemId)->pivot->attempt < 2) {
                if($problem->attempts == 1) {
                    return json_encode(["message" => 'only_one_attempt']);
                } else {
                    $attempt = 2;
                    Auth::user()->problems()->updateExistingPivot($problemId, ['attempt' => 2, 'success' => $success]);
                }
            } else {
                return json_encode(["message" => 'attempt_exhausted']);
            }

        } else {
            Log::error('Multiply task user'.Auth::user()->id.' problem'.$problemId);
            App::abort(500, 'Multiply task user'.Auth::user()->id.' problem'.$problemId);
        }

        //Auth::user()->load('problems'); // needed, and Auth::user()->fresh(['problems']) - does not work
        //var_dump(Auth::user()->problems->find($problemId)->pivot->attempt);
        $retry = ($attempt < 2) && ($problem->attempts > 1);

        $answer = (!$success && !$retry) ? $problem->answer : '';

        return json_encode(["message" => $success ? 'success' : 'fail', "retry" => $retry ? 'yes' : 'no', 'answer' => $answer]);
    }
}
