<?php

namespace App\Http\Controllers;

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

        return view('admin.lection', ['page' => $lection]);
    }

    public function save($id = null, Request $request)
    {
        $validator = Validator::make(array_merge($request->all()),
            [
                'title' => 'required|max:1024',
                'content' => 'max:10000',
            ]
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
            $page->parent_id = $request->input('parent_id');

            $page->save();
        } else {
            $page = Page::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'type' => 'lection',
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
