<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Course;
use Validator;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $course = Course::find($id);

        $course = $course ? : new Course;

        return view('admin.course', ['course' => $course]);
    }

    public function save($id = null, Request $request)
    {
        $validator = Validator::make(array_merge($request->all()),
            [
                'title' => 'required|max:1024' . (($id == 'new') ? '|unique:courses' : ''),
                'description' => 'max:15000',
            ]
        );

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if (!empty($request->input('course_id'))) {
            $course = Course::find($request->input('course_id'));

            $course->title = $request->input('title');
            $course->description = $request->input('description');
            $course->color = $request->input('color');

            $course->save();
        } else {
            $course = Course::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'color' => $request->input('color'),
            ]);
        }

        return redirect('admin/course/'.$course->id)
            ->with([
                'message' => 'Изменения сохранены',
            ]);
    }

    public function delete($id)
    {
        Course::destroy($id);

        return redirect('admin/course/new')
            ->with([
                'message' => 'Содержимое удалено',
            ]);
    }
}
