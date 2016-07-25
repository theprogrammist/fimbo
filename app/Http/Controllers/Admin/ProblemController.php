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

        if(!$problem){
            $problem = new Problem();
            $problem->question = json_encode([
                'type' => 'radio',
                'radio' => [
                    'number' => -1,
                    'texts' => [''],
                ],
                'checkbox' => [
                    'numbers' => [],
                    'texts' => [''],
                ],
                'single' => ''
            ]);
        }

        return view('admin.problem', ['problem' => $problem,
            'question' => json_decode($problem->question)]);
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
                'annotation' => 'max:1024',
            ]
        );

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        //die(var_dump($request->has('single_quesiton'),$request->exists('single_quesiton')));
        $question = [
            'type' => $request->input('question_type'),
            'radio' => [
                'number' => $request->input('radio_question'),
                'texts' => $request->input('radio_quesiton_text'),
            ],
            'checkbox' => [
                'numbers' => $request->input('checkbox_question'),
                'texts' => $request->input('checkbox_quesiton_text'),
            ],
            'single' => $request->input('single_quesiton')
        ];



        if (!empty($request->input('problem_id'))) {
            $problem = Problem::find($request->input('problem_id'));

            $problem->title = $request->input('title');
            $problem->annotation = $request->input('annotation');
            $problem->description = $request->input('description');
            $problem->question = json_encode($question);
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
                'annotation' => $request->input('annotation'),
                'description' => $request->input('description'),
                'question' => json_encode($question),
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
