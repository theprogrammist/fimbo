<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Page;
use App\Problem;
use Validator;

class ProblemController extends Controller
{
    public function show($problemId = null, Request $request)
    {
        $problem = Problem::find($problemId);
        session(['problemSliderStart' => $problemId]);
        return view('home', ['problem' => $problem,
            'question' => json_decode($problem->question)]);
    }

    public function solution($problemId = null, Request $request)
    {

        $problem = Problem::find($problemId);
        $question = json_decode($problem->question);

        $success = false;
        if ($question->type == 'single') {

            if ($request->has('single')) {
                $success = ($request->input('single') == $question->single);
            }

        } elseif ($question->type == 'radio') {
            die('test');

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

        return (string)$success ? 'success' : 'fail';
    }
}
