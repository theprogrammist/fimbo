<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Page;
use Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $users = User::all();
        return view('admin.dashboard', ['users' => $users]);
    }

    public function staticContent($name)
    {
        $page = Page::whereName($name)->first();

        $page = empty($page) ? new Page : $page;

        return view('admin.static-content', ['page' => $page]);
    }

    public function deleteStaticContent($name, $id, Request $request)
    {
        Page::destroy($id);

        return redirect()->route('staticContent', ['name' => $name])
            ->with([
                'message' => 'Содержимое удалено',
            ]);
    }

    public function saveStaticContent($name, Request $request)
    {
        $validator = Validator::make(array_merge(['name' => $name], $request->all()),
            [
                'title' => 'required|max:1024',
                'content' => 'max:10000',

            ]
            + (empty($request->input('page_id')) ? ['name' => 'required|unique:pages'] : [])
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
            $page->type = 'static';
            $page->name = $name;

            $page->save();
        } else {
            Page::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'type' => 'static',
                'name' => $name
            ]);
        }

        return redirect()->route('staticContent', ['name' => $name])
            ->with([
                'message' => 'Изменения сохранены',
            ]);
    }

    /**
     * Moves file to store folder, returns created file name, encapsulates file naming manner
     * @param $file Request->file object
     * @return string name of stored file
     */
    private static function uploadFile($file)
    {
        $fileName = time() . str_random(10) . '.' .
            $file->getClientOriginalExtension();

        $file->move(
            base_path() . '/public/images/', $fileName
        );

        return $fileName;
    }

    public function upload(Request $request)
    {
        $imageName = self::uploadFile($request->file('image'));

        return "top.$('.mce-btn.mce-open').parent().find('.mce-textbox').val('" . url('/') . "/images/{$imageName}').closest('.mce-window').find('.mce-primary').click();";
        //  return HttpResponse("<script>alert('%s');</script>" % escapejs('\n'.join([v[0] for k, v in form.errors.items()])))
    }
}
