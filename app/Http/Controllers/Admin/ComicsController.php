<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Page;
use Validator;

class ComicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $lection = Page::find($id);

        $lection = empty($lection) ? new Page : $lection;

        return view('admin.comics', ['page' => $lection, 'id' => $id]);
    }

    public function save($id = null, Request $request)
    {
        $isLectionPage = ((Page::find($request->input('page_id')) && Page::find($request->input('page_id'))->parent)
            || ($request->segment(2) === 'comics' && $request->segment(3) === 'newpage'))
            ? true : false;

        $validator = Validator::make(array_merge($request->all()),
            [
                //'title' => 'required|max:1024',
                'content' => 'max:15000',
                'number' => 'required',
            ]
            + ($isLectionPage ? [] : ['title' => 'required|max:1024'])
        );

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if ($request->hasFile('l_img_new')) {
            $l_img = AdminController::uploadFile($request->file('l_img_new'));
        } elseif ($request->has('l_img')) {
            $l_img = $request->input('l_img');
        } else {
            $l_img = '';
        }

        if ($request->hasFile('r_img_new')) {
            $r_img = AdminController::uploadFile($request->file('r_img_new'));
        } elseif ($request->has('r_img')) {
            $r_img = $request->input('r_img');
        } else {
            $r_img = '';
        }


        if (!empty($request->input('page_id'))) {
            $page = Page::find($request->input('page_id'));

            $page->title = $request->input('title');
            $page->content = $request->input('content');
            $page->type = 'comics';
            if ($request->has('parent_id')) {
                $page->parent_id = $request->input('parent_id');
            }
            $page->number = $request->input('number');
            $page->difficulty = $request->input('difficulty');
            $page->course_id = trim($request->input('course_id'));
            $page->l_img = $l_img;
            $page->r_img = $r_img;

            $page->save();
        } else {
            $page = Page::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'type' => 'comics',
                'number' => $request->input('number'),
                'difficulty' => $request->input('difficulty'),
                'course_id' => trim($request->input('course_id')),
                'parent_id' => $request->input('parent_id'),
                'l_img' => $l_img,
                'r_img' => $r_img,
            ]);
        }

        return redirect('admin/comics/' . $page->id)
            ->with([
                'message' => 'Изменения сохранены',
            ]);
    }

    public function delete($id)
    {
        Page::destroy($id);

        return redirect('admin/comics/new')
            ->with([
                'message' => 'Содержимое удалено',
            ]);
    }
}
