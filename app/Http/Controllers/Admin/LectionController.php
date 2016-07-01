<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Page;
use Validator;

class LectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $lection = Page::find($id);

        $lection = empty($lection) ? new Page : $lection;

        return view('admin.lection', ['page' => $lection, 'id' => $id]);
    }

    public function save($id = null, Request $request)
    {
        $isLectionPage = ((Page::find($request->input('page_id')) && Page::find($request->input('page_id'))->parent)
            || ($request->segment(2) === 'lection' && $request->segment(3) === 'newpage'))
            ? true : false;

        $validator = Validator::make(array_merge($request->all()),
            [
                //'title' => 'required|max:1024',
                'content' => 'max:15000',
            ]
            + ($isLectionPage ? [] : [ 'title' => 'required|max:1024' ])
        );

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if (!empty($request->input('page_id'))) {
            $page = Page::find($request->input('page_id'));

            $page->title = $request->input('title');
            $page->content = $request->input('content');
            $page->type = 'lection';
            if($request->has('parent_id')) {
                $page->parent_id = $request->input('parent_id');
            }
            $page->number = $request->input('number');
            $page->difficulty = $request->input('difficulty');
            $page->course = trim($request->input('course'));

            $page->save();
        } else {
            $page = Page::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'type' => 'lection',
                'number' => $request->input('number'),
                'difficulty' => $request->input('difficulty'),
                'course' => trim($request->input('course')),
                'parent_id' => $request->input('parent_id'),
            ]);
        }

        return redirect('admin/lection/'.$page->id)
            ->with([
                'message' => 'Изменения сохранены',
            ]);
    }

    public function delete($id)
    {
        Page::destroy($id);

        return redirect('admin/lection/new')
            ->with([
                'message' => 'Содержимое удалено',
            ]);
    }
}
