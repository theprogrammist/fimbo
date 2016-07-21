<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Problem;
use Validator;

class ProblemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $problem = Problem::find($id);

        $problem = $problem ?: new Problem();

        return view('admin.problem', ['problem' => $problem]);
    }

    public function save($id = null, Request $request)
    {
        $validator = Validator::make(array_merge($request->all()),
            [
                'title' => 'required|max:1024',
                'description' => 'required|max:15000',
                'answer' => 'required|max:15000',
                'score' => 'required|Numeric',
                'attempts' => 'required|Numeric',
                'difficulty' => 'required|Numeric',
                'course_id' => 'exists:courses,id',
                //'question' => 'required|max:15000',
            ]
        );

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if (!empty($request->input('problem_id'))) {
            $problem = Problem::find($request->input('problem_id'));

            $problem->title = $request->input('title');
            $problem->description = $request->input('description');
            //$problem->question = $request->input('question');
            $problem->answer = $request->input('answer');
            $problem->number = $request->input('number');
            $problem->score = $request->input('score');
            $problem->attempts = $request->input('attempts');
            $problem->difficulty = $request->input('difficulty');
            $problem->course_id = $request->input('course_id');

            $problem->save();
        } else {
            $problem = Problem::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                //'question' => $request->input('question'),
                'answer' => $request->input('answer'),
                'number' => $request->input('number'),
                'score' => $request->input('score'),
                'attempts' => $request->input('attempts'),
                'difficulty' => $request->input('difficulty'),
                'course_id' => $request->input('course_id'),
            ]);
        }

        //$problem->lections()->findOrNew(\App\Page::find(12));
        //var_dump(array_filter($request->input('lections')));
        //die(var_dump($request->input('lections',[]), $request->input('new_lections',[])));
        //die();
        $problem->lections()->detach();
        $problem->lections()->attach(array_unique(array_merge($request->input('lections',[]), $request->input('new_lections',[]))));

        return redirect('admin/problem/' . $problem->id)
            ->with([
                'message' => 'Изменения сохранены',
            ]);
    }

    public function delete($id)
    {
        Problem::destroy($id);

        return redirect('admin/problem/new')
            ->with([
                'message' => 'Содержимое удалено',
            ]);
    }
}
